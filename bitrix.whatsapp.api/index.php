<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from https://bootdey.com  -->
    <!--  All snippets are MIT license https://bootdey.com/license -->
    <title>Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container app">
  <div class="row app-one">
    

    <div class="col-sm-12 conversation">
      

      <div class="row message" id="conversation">
        

        
      </div>

      <div class="row reply">
        
        <div class="col-sm-10 col-xs-10 reply-main">
          <textarea class="form-control" rows="1" id="comment"></textarea>
        </div>
        <div class="col-sm-1 col-xs-1 reply-recording">
          <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
        </div>
        <div class="col-sm-1 col-xs-1 reply-send">
          <i class="fa fa-send fa-2x" aria-hidden="true" id="send"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
//Date function
$.date = function(dateObject) {
  if (dateObject != null){
    var d = new Date(dateObject);
    }
  else{
    var d = new Date();
  }
    var day = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    var hour = d.getHours();
    var minute = d.getMinutes();
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    var date = hour + ':' + minute + ' ' + day + "/" + month + "/" + year;

    return date;
};



$('#send').on('click', function(){
  var answer = $('#comment').val();
  if (answer != ""){
  
    var url = 'https://eu7.chat-api.com/instance5564/message?token=1kh42nge473ui6vn';
    var data = {
        phone: '380668104142', // Телефон получателя
        body: answer, // Сообщение
    };

    $.ajax(url, {
      data : JSON.stringify(data),
      contentType : 'application/json',
      type : 'POST'
    });
    $('#comment').val('');

    
    var time = $.date();
    var answerDiv = '<div class="row message-body"><div class="col-sm-12 message-main-sender"><div class="sender"><div class="message-text">';
    answerDiv += answer;
    answerDiv += '</div><span class="message-time pull-right">' + time + '</span>';
    answerDiv += '</div></div></div></div>';
    $('#conversation').append(answerDiv)
  }
});

//По нажатию на enter
$('#comment').keydown(function(e){ 
    if (e.keyCode == 13) { 
      var answer = $('#comment').val();
      if (answer != ""){
      
        var url = 'https://eu7.chat-api.com/instance5564/message?token=1kh42nge473ui6vn';
        var data = {
            phone: '380668104142', // Телефон получателя
            body: answer, // Сообщение
        };

        $.ajax(url, {
          data : JSON.stringify(data),
          contentType : 'application/json',
          type : 'POST'
        });
        $('#comment').val('');
        var time = $.date();
        var answerDiv = '<div class="row message-body"><div class="col-sm-12 message-main-sender"><div class="sender"><div class="message-text">';
        answerDiv += answer;
        answerDiv += '</div><span class="message-time pull-right">' + time + '</span>';
        answerDiv += '</div></div></div></div>';
        $('#conversation').append(answerDiv)
      }
    }
});


//Getting message
var url = 'https://eu7.chat-api.com/instance5564/messages?token=1kh42nge473ui6vn&chatId=380668104142@c.us'
$.get(url, function (data) { // Выполним GET запрос на URL
    var lastNumber = data.lastMessageNumber;
      
    for (var i = data.lastMessageNumber - 10; i < data.messages.length - 1; i++) { // Для каждого сообщения
      var time = $.date(data.messages[i].time*1000);
      var message = data.messages[i].body;
      
      if (data.messages[i].fromMe === true) {
        
        
        var messageDiv = '<div class="row message-body"><div class="col-sm-12 message-main-sender"><div class="sender"><div class="message-text">';
        if(data.messages[i].type == 'chat'){

      
        messageDiv += message;
        }
        else if (data.messages[i].type == 'image'){
         messageDiv += '<img src="'+message+'" alt="Задана ширина" width="300">'; 
        }
        else {
         messageDiv += '<a href="'+message+'">Some doc\'s</a>';  
        };
        
      }
      else{
        
        
        var messageDiv = '<div class="row message-body"><div class="col-sm-12 message-main-receiver"><div class="receiver"><div class="message-text">';
        if(data.messages[i].type == 'chat'){

      
        messageDiv += message;
        }
        else if (data.messages[i].type == 'image'){
         messageDiv += '<img src="'+message+'" alt="Задана ширина" width="300">'; 
        }
        else {
         messageDiv += '<a href="'+message+'">Some doc\'s</a>';  
        };
        
      };
      
      
      messageDiv += '</div><span class="message-time pull-right">' + time + '</span>';
      messageDiv += '</div></div></div></div>';
      $('#conversation').append(messageDiv);
    }
    });
    




function getMessage(lastMessageNumber){
$.get(url, function (data) { // Выполним GET запрос на URL
    var lastNumber = data.lastMessageNumber;
    console.log(lastNumber);
    if (lastMessageNumber != data.lastMessageNumber){
    for (var i = data.lastMessageNumber - 1; i < data.messages.length; i++) { // Для каждого сообщения
       var time = $.date(data.messages[i].time*1000);
       var message = data.messages[i].body;
      
      if (data.messages[i].fromMe === true) {
        
        
        var messageDiv = '<div class="row message-body"><div class="col-sm-12 message-main-sender"><div class="sender"><div class="message-text">';
        if(data.messages[i].type == 'chat'){

      
        messageDiv += message;
        }
        else if (data.messages[i].type == 'image'){
         messageDiv += '<img src="'+message+'" alt="Задана ширина" width="300">'; 
        }
        else {
         messageDiv += '<a href="'+message+'">Some doc\'s</a>';  
        };
        
      }
      else{
        
        
        var messageDiv = '<div class="row message-body"><div class="col-sm-12 message-main-receiver"><div class="receiver"><div class="message-text">';
        if(data.messages[i].type == 'chat'){

      
        messageDiv += message;
        }
        else if (data.messages[i].type == 'image'){
         messageDiv += '<img src="'+message+'" alt="Задана ширина" width="300">'; 
        }
        else {
         messageDiv += '<a href="'+message+'">Some doc\'s</a>';  
        };
        
      };
      
      
      messageDiv += '</div><span class="message-time pull-right">' + time + '</span>';
      messageDiv += '</div></div></div></div>';
      $('#conversation').append(messageDiv);
    }
    };
    setTimeout(getMessage, 1000, lastNumber);



});



};

getMessage(0);



</script>

<?php 


?>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(function(){
    $(".heading-compose").click(function() {
      $(".side-two").css({
        "left": "0"
      });
    });

    $(".newMessage-back").click(function() {
      $(".side-two").css({
        "left": "-100%"
      });
    });
})
</script>
</body>
</html>