<?php
include_once 'header.php';
include_once 'includes/messages_functions.inc.php';

$contacts = contacts();
$messages = messages();
?>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.containers {
    display: flex;
    justify-content: space-between;
    align-items: stretch;
    height: 85vh;
    background-color: #f2f2f2;
    border-radius: 10px;
}

.contacts {
    flex: 1;
    padding: 20px;
    background-color: #fff;
    color: black;
}

.contacts h2 {
    margin-bottom: 15px;
    color: black;
}

.contacts ul {
    list-style-type: none;
    padding: 0;
}

.contact {
    padding: 10px 0;
    cursor: pointer;
    color: black;
}

.contact:hover {
    background-color: #555;
}

.messages {
    flex: 3;
    display: flex;
    flex-direction: column;
    background-color: rgb(211, 211, 211, 0.3);
    justify-content: space-between; /* Add this line */
    max-width:70%;
}
.messages-header{
  background-color: #fff;
  height: 70px;
}

.message-container {
    flex-grow: 1;
    padding: 20px;
    display: flex;
    flex-direction: column;
    max-height: 100%; /* Set a maximum height for the message container */
    overflow-y: auto; /* Enable vertical scroll when messages exceed max-height */
    max-width: 100%;
}

.sent {
    background-color: #0084ff;
    color: white;
    padding: 10px;
    border-radius: 5px;
    display: inline-block;
    vertical-align: top;
    margin-bottom: 10px;
    margin-left: auto;
    word-wrap: break-word;
    max-width: 60%;
}
.received {
    background-color: #0084ff;
    color: white;
    padding: 10px;
    border-radius: 5px;
    display: inline-block;
    vertical-align: top;
    margin-bottom: 10px;
    margin-right: auto;
    word-wrap: break-word;
    max-width: 60%;
}

#message-form {
    display: flex;
    align-items: center;
    padding: 10px;
    background-color: #fff;
    justify-content: flex-end; /* Add this line */
}

#message-input {
    flex-grow: 2;
    padding: 10px;
    border: none;
    border-radius: 5px;
    outline: none;
}

#send-button {
    padding: 10px 20px;
    background-color: #0084ff;
    color: white;
    border: none;
    border-radius: 5px;
    margin-left: 10px;
    cursor: pointer;
}

#send-button:hover {
    background-color: #0056b3;
}


</style>
<div class="messages-feed">
<div class="containers">
        <div class="contacts">
            <h2>Contacts</h2>
            <?php
            foreach ($contacts as $contact) {
                $contact_name = $contact['fclt_name'];
                $contact_id = $contact['fclt_id'];

                // Add your condition here, for example, to skip a specific row:
                if ($contact_id != $fclt_id) {
            ?>
                <div class="referral-card"  id="message-contact" data-contact-name="<?php echo $contact_name; ?>" data-contact-id="<?php echo $contact_id; ?>">
                    <div class="mini-referral-logo" id="message-logo">
                        <img src="images/person.png" alt="Logo" class="logo">
                    </div>
                    <div class="info">
                        <div class="name"><?php echo $contact_name; ?></div>
                        <div class="description">Ambobo mo tanga • 2:35 PM</div>
                    </div>
                </div>
            <?php
                }
            }
            ?>
</div>
<div class="messages" id="messages">
<nav class="messages-header">
    <div class="referral-card" data-contact-name="">
        <div class="mini-referral-logo" id="message-logo">
            <img src="images/person.png" alt="Logo" class="logo">
        </div>
        <div class="info">
            <div class="name" id="contact_name">Caraga Hospital</div>
            <div class="description">Active</div>
        </div>
    </div>
</nav>
            <div class="message-container" id="message-container">
                
            </div>
            <div class="input-container">
            <form id="message-form">
                <input type="text" id="message-input" name="message" placeholder="Type your message...">
                <button id="send-button" type="submit" >Send</button>
            </form>
            </div>
        </div>
    </div>
    </div>
    
<script>




</script>
<?php
include_once 'footer.php'
?>