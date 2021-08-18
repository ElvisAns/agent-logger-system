
<?php

header("location : index.asp")

?>

<script type="text/javascript">
    
setInterval(function showLog(){
    
    
    if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
    }
    else{
        xmlhttp= new AcriveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function(){

        if(this.readyState==4 && this.status==200){

            var attendance_table = JSON.parse(this.responseText); 
            console.log(attendance_table);
                
        }
    };
    xmlhttp.open("GET","view_log_table.php",true);
    xmlhttp.send();


},1000);

setInterval(function monitorComPortData(){
    
    
    if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
    }
    else{
        xmlhttp= new AcriveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function(){

        if(this.readyState==4 && this.status==200){

            if (this.responseText.length>0){
            var userData = JSON.parse(this.responseText); //The info of the user and record it in database!
            console.log(userData);

          if(typeof(userData.Names) != undefined)  {
            
            try{
                var msg = new SpeechSynthesisUtterance();
            var voices = window.speechSynthesis.getVoices();
            msg.voice = voices[10]; // Note: some voices don't support altering params
            msg.voiceURI = 'native';
            msg.volume = 1; // 0 to 1
            msg.rate = 1; // 0.1 to 10
            msg.pitch = 1; //0 to 2
            userData.Time=userData.Time.slice(0,-3);
            heure=userData.Time.slice(0,3);
            minute=userData.Time.slice(4,7);
            msg.text = userData.Names.toString()+ "\r\n Il est :" + heure.toString() + "heures" + minute.toString() + "minutes" ;
            msg.lang = 'fr-FR';

            msg.onend = function(e) {
              console.log('Finished in ' + event.elapsedTime + ' seconds.');
            };

            speechSynthesis.speak(msg);
            
            }
            catch(e){

            }
            }
            }    
        }
    };
    xmlhttp.open("GET","load_config.php",true);
    xmlhttp.send();



},400);



</script>