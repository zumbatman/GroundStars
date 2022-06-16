<?php
$utilisateurs = 
[
    ['mail' => 'admin@groundstars.gs', 'motdepasse' => password_hash( "bonjour1234",PASSWORD_DEFAULT), 'cle' => rand(100000, 9000000), 'id' => 1, 'role' => 'Administrateur', 'confirme' => 1],
    ['mail' => 'david.gatel@groundstars.gs', 'motdepasse' => password_hash( "bonjour1234",PASSWORD_DEFAULT), 'cle' => rand(100000, 9000000), 'id' => 2, 'role' => 'Administrateur', 'confirme' => 1],
    ['mail' => 'francois-regis.menguy@groundstars.gs', 'motdepasse' => password_hash( "bonjour1234",PASSWORD_DEFAULT), 'cle' => rand(100000, 9000000), 'id' => 3, 'role' => 'Administrateur', 'confirme' => 1],
    ['mail' => 'user1@groundstars.gs', 'motdepasse' => password_hash( "bonjour1234",PASSWORD_DEFAULT), 'cle' => rand(100000, 9000000), 'id' => 4, 'role' => 'Administrateur', 'confirme' => 1],

];
file_put_contents("data/users.json", json_encode($utilisateurs, JSON_PRETTY_PRINT));
?>