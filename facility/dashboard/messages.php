<?php
include_once 'header.php';
include_once 'includes/messages_functions.inc.php';
?>
<link rel="stylesheet" href="css/chat.css?v=<?php echo time();?>">

<div class="messages-feed">
    <div class="containers">
        <div class="contacts">
        <h2>Contacts</h2>
        <div class="col-12">
            <div class="input-group mb-3">
                <input type="text" id="search-input" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-search">
                <button class="btn btn-primary" type="button" id="button-search"><i class="fi fi-rr-search"></i></button>
            </div>
        </div>
        <div class="contacts-list">
            
        </div> 
        </div>  
        <div class="messages" id="messages">
            <nav class="messages-header">
                
            </nav>
            <!-- Display area for messages -->
        <div id="message-container" class="message-container">
        <div class="sender" data-toggle="tooltip" data-placement="left" title="10:45 PM">
            asdad
        </div>
        <div class="sender" data-toggle="tooltip" data-placement="left" title="11:35 AM">
            asdad
        </div>

        </div>
            <div class="input-container">
            <form action="#" id="message-form" class="type-area" autocomplete="off">
                <input type="hidden" value="<?php echo $fclt_id = $_SESSION['fcltid']?>" id="sender_id" name="sender_id">
                <input type="hidden" value="" name="receiver_id" id="receiver_id">
                <input type="text" id="message-input" class="input-field" name="message" placeholder="Type your message...">
                <button id="send-button" class="btn">Send</button>
                <button id="sending-button" class="btn d-none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending..
                </button>
            </form>
            </div>
        </div>
    </div>
</div>

<script src="js/ajaxMessages.js"></script>

<?php
include_once 'footer.php';
?>