<?php 
ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","465");
mail("alexis.d.japan@gmail.com", "Essai", "Coucou ceci est un test", "");
?>