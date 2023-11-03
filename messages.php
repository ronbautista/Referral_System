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
    padding: 7px 15px;
    border-radius: 10px;
    margin-bottom: 5px;
    margin-left: auto;
    word-wrap: break-word;
    max-width: 60%;
    text-align: center;
}
.received {
    background-color: #0084ff;
    color: white;
    padding: 7px 15px;
    border-radius: 10px;
    margin-bottom: 5px;
    margin-right: auto;
    word-wrap: break-word;
    max-width: 60%;
    text-align: center;
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
.three-dots {
    display: inline-block; /* Display the three dots as inline elements */
    vertical-align: middle; /* Align the three dots vertically in the middle */
    margin-left: 5px; /* Add some spacing between the message and the three dots */
    /* You can further customize the styles of the three dots as needed */
}
.messages-head {
  display: flex;
  padding: 10px;
  align-items: center;
  transition: all 0.3s;
  border-radius: 10px;
}

.messages-head-logo {
  width: 50px; /* Reduce the width to make the logo smaller */
  height: 50px; /* Reduce the height to make the logo smaller */
  padding: 10px;
  border-radius: 50%;
  margin-right: 16px;
  margin-left: 0;
  object-fit: cover;
  display: flex; /* Center its contents vertically and horizontally */
  align-items: center; /* Center vertically */
  justify-content: center; /* Center horizontally */
}
.messages-head img {
  width: 25px; /* Adjust the width of the logo within the mini-referral-logo */
  height: 25px; /* Adjust the height of the logo within the mini-referral-logo */
}

.messages-feed {
  background-color: #ffffff;
  border-radius: 10px;
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
                <div class="referral-card" id="message-contact" data-contact-name="<?php echo $contact_name; ?>" data-contact-id="<?php echo $contact_id; ?>">
                    <div class="mini-referral-logo" id="message-logo">
                        <img src="images/person.png" alt="Logo" class="logo">
                    </div>
                    <div class="info">
                        <div class="name"><?php echo $contact_name; ?></div>
                        <div class="description" id="latestMessage"></div>
                    </div>
                </div>
            <?php
                }
            }
            ?>
</div>
<div class="messages" id="messages">
<nav class="messages-header">
    <div class="messages-head" data-contact-name="">
        <div class="messages-head-logo" id="message-logo">
            <img src="images/person.png" alt="Logo" class="logo">
        </div>
        <div class="info">
            <div class="name" id="contact_name"></div>
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

<?php
include_once 'footer.php'
?>