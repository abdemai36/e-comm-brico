<?php

    include_once('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Templates/SidBar.php');
?>

    <div class="Main">
        <div class="Card">
            <div class="Card-images">
                <img class="Big-img" src="Layout/Images/4eb5c0cf61039dd2ec52f38016b1f31da966fcd7.png" alt="image">
                <div class="small-imgs">
                    <img class="Big-img" src="Layout/Images/4eb5c0cf61039dd2ec52f38016b1f31da966fcd7.png" alt="image">
                    <img class="Big-img" src="Layout/Images/4eb5c0cf61039dd2ec52f38016b1f31da966fcd7.png" alt="image">
                    <img class="Big-img" src="Layout/Images/4eb5c0cf61039dd2ec52f38016b1f31da966fcd7.png" alt="image">  
                </div>
            </div>
            <div class="Card-body">
                <h2>Titel</h2>
                <span class="ref">ref: A52465</span>
                <div class="Prices">
                    <span>599 DH</span>
                    <span>1200 DH</span>
                </div>
                <span style='margin-top: 8px;'>Disponibilité:<span>Stock</span></span>
                <div class="controls-qeuntity">
                    <input type="number">
                    <button>acheter maintenant</button>
                </div>
                <div class="contactes">
                    <i class="fab fa-whatsapp-square wtsp"></i>
                    <i class="fab fa-facebook-square fb"></i>
                    <i class="fab fa-instagram insta"></i>
                    
                </div>
            </div>
        </div>
    </div>

<?php
    include_once('Includes/Templates/footer.php');
?>