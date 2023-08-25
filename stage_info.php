<?php if(!isset($_GET['inf'])){
    header("location: index.php");
    exit;
}else{
    
    include("includes/db.php");

    $q_id = $bdd -> prepare("SELECT id,nom FROM travel_stages WHERE nom = ?");

    $q_id -> execute([$_GET['inf']]);

    

    $data_id = $q_id -> fetch(PDO::FETCH_ASSOC);

    if ($q_id-> rowCount() == 0){
        header("location: index.php");
        exit;
    }

    $q_res = $bdd -> prepare("SELECT * FROM activities WHERE travel_stage_id = ?");

    $q_res -> execute([$data_id['id']]);

    $data_res = $q_res -> fetchAll(PDO::FETCH_ASSOC);

    $q_acco = $bdd -> prepare("SELECT * FROM accommodations WHERE travel_stage_id = ?");

    $q_acco -> execute([$data_id['id']]);

    $data = $q_acco -> fetchAll(PDO::FETCH_ASSOC);


}
?>

<html>

<head>
    
<?php include("includes/head.php"); ?>

</head>


<body>
    <h1> <?= $data_id['nom'] ?> </h1>
    <h2> Hôtels </h2>

    <table>
        <tr> 
            <th> Nom </th> 
            <th> Adresse </th> 
            <th> Prix </th>
            <th> Actions </th>


        </tr>


        <?php 
            foreach($data as $value){
                echo'
                <tr> 
                    <th> ' . $value['nom'] . '</th>
                    <th> ' . $value['adress'] . '</th>
                    <th> ' . $value['price_per_night'] . '</th>
                    <th> ' . 'Réserver' . '</th>
                
                
                ';
            }
        ?>
    </table>

    <h2> Activités </h2>

    <table>
        <tr> 
            <th> Nom </th> 
            
            <th> Actions </th>


        </tr>


        <?php 
            foreach($data_res as $value){
                echo'
                <tr> 
                    <th> ' . $value['nom'] . '</th>

                    <th> ' . 'Réserver' . '</th>
                
                
                ';
            }
        ?>
    </table>



</body>










</html>