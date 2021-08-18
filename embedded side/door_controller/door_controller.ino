
#include <MFRC522.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <SPI.h >
#include <Servo.h>


ESP8266WiFiMulti WiFiMulti;
#define RST_PIN 0 // RST-PIN for RC522 - RFID - SPI - Modul GPIO15 
#define SS_PIN  2  // SDA-PIN for RC522 - RFID - SPI - Modul GPIO2
#define BUZZER 4 //D2
#define RED_LIGHT 16 //D0
#define YELLOW_LIGHT 15 //D8
#define MOTOR_CONTROL 5 //D1
MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance

Servo door_opener;

int frequency = 2000;
char *UID;
String data, tag;

void setup() {
  const uint16_t port = 80;
  const char * host = "192.168.43.240/"; // ip or dns
  pinMode(BUZZER, OUTPUT);
  pinMode(RED_LIGHT, OUTPUT);
  pinMode(YELLOW_LIGHT, OUTPUT);
  door_opener.attach(MOTOR_CONTROL);
  digitalWrite(BUZZER, LOW);
  digitalWrite(YELLOW_LIGHT, LOW);
  digitalWrite(RED_LIGHT, HIGH);
  Serial.begin(9600);
  SPI.begin();           // Init SPI bus
  mfrc522.PCD_Init();    // Init MFRC522
  delay(30);


  // We start by connecting to a WiFi network
  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP("door_opener_system", "12345678door");

  Serial.println();
  Serial.println();
  Serial.print("Wait for WiFi... ");

  while (WiFiMulti.run() != WL_CONNECTED) {
    Serial.print(".");
    delay(10);
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");

  Serial.println(WiFi.localIP());
  Serial.print("connected to ");
  Serial.println(host);
}

void loop() {

  const uint16_t port = 80;
  const char * host = "192.168.43.240/"; // ip or dns

  HTTPClient http;


  if ( ! mfrc522.PICC_IsNewCardPresent()) {
    delay(20);
    return;
  }
  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial()) {
    delay(20);
    return;
  }

  for (byte i = 0; i <  mfrc522.uid.size; i++) {
    tag += mfrc522.uid.uidByte[i];
  }
  data += tag ;
  String Link = "http://192.168.43.240/agent_logger/backend/end_point_for_device.php?card_id=" + data;
  http.begin(Link);
  int httpCode = http.GET();
  String response = http.getString();
  Serial.println(Link);
  Serial.println(httpCode);
  http.end();
  tag = "";
  data = "";
  if (httpCode == 200) {
    if (response.indexOf("granted") != -1) {
      //acces granted
      tone(BUZZER, frequency);
      digitalWrite(RED_LIGHT, LOW);
      digitalWrite(YELLOW_LIGHT, HIGH);
      delay(2000);
      noTone(BUZZER);
      digitalWrite(RED_LIGHT, 1);
      digitalWrite(YELLOW_LIGHT, 0);
      delay(500);
      
      for (int i = 0; i <= 120; i++) { //open the door
        door_opener.write(i);
        delay(30);
      }
         
      for (int i = 120; i >= 0; i--) { //close the door
        door_opener.write(i);
        delay(10);
      }
    }

    else {
      //access denied
      for (int x = 0; x < 3; x++) {
        tone(BUZZER, frequency);
        digitalWrite(RED_LIGHT, LOW);
        digitalWrite(YELLOW_LIGHT, HIGH);
        delay(100);
        noTone(BUZZER);
        digitalWrite(RED_LIGHT, 1);
        digitalWrite(YELLOW_LIGHT, 0);
        delay(500);
      }
    }
  }

  else {

    for (int x = 0; x < 3; x++) {
      tone(BUZZER, frequency);
      digitalWrite(RED_LIGHT, LOW);
      digitalWrite(YELLOW_LIGHT, HIGH);
      delay(100);
      noTone(BUZZER);
      digitalWrite(RED_LIGHT, 1);
      digitalWrite(YELLOW_LIGHT, 0);
      delay(150);
    }
  }
}
