
  

<style>
* {box-sizing: border-box;}

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border-radius:5px;
  border: none;
  background: #f1f1f1;
  resize: none;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>

<body>
  <h1 style="margin:1em; text-align: center;"> Chat Room </h1>

<button class="open-button" onclick="openForm()">Chat</button>

<div class="chat-popup" id="myForm">
  <form  class="form-container">
    <h1>Chat Room<button type="button" style="width:5em;" class="btn cancel" onclick="closeForm()">Close</button></h1>
    <textarea id="received" rows="10" cols="50" disabled></textarea>
    <textarea id="text" placeholder="Type message.." name="msg" rows="3"  required></textarea>
    <button type="submit" class="btn">Send</button>
    <!-- <button type="button" class="btn cancel" onclick="closeForm()">Close</button> -->
  </form>
</div>


</body>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script> 
    var time = 0;
   
    var updateTime = function (cb) {
      $.getJSON("<?php echo base_url();?>chat/time", function (data) {
          cb(~~data);
      });
    };
     
    var sendChat = function (message, cb) {
      $.getJSON("<?php echo base_url();?>chat/insert_chat?message=" + message, function (data){
        alert("get json");
        cb();
      });
    }
     
    var addDataToReceived = function (arrayOfData) {
      arrayOfData.forEach(function (data) {
        $("#received").val($("#received").val() + "\n" + data[0]);
      });
    }
     
    var getNewChats = function () {
      $.getJSON("<?php echo base_url();?>chat/get_chats?time=" + time, function (data){
        addDataToReceived(data);
        // reset scroll height
        setTimeout(function(){
           $('#received').scrollTop($('#received')[0].scrollHeight);
        }, 0);
        time = data[data.length-1][1];
      });      
    }
   
    // using JQUERY's ready method to know when all dom elements are rendered
    $( document ).ready ( function () {
      // set an on click on the button
      $("form").submit(function (evt) {
        evt.preventDefault();
        var data = $("#text").val();
        $("#text").val('');
        // get the time if clicked via a ajax get queury
        sendChat(data, function (){
          alert("dane");
        });
      });
      setInterval(function (){
        getNewChats(0);
      },1500);
    });

    function openForm() {
        document.getElementById("myForm").style.display = "block";
        }
        
    function closeForm() {
        document.getElementById("myForm").style.display = "none";
        }
     
  </script>

<!-- <body>
  <h1> Chat Example on Codeigniter </h1>
   
  <textarea id="received" rows="10" cols="50">
  </textarea>
  <form>
    <input id="text" type="text" name="user">
    <input type="submit" value="Send">
  </form>
</body> -->