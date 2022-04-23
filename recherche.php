<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Recherche spé</h1><hr>
    <form action="recherche.php" methode="post">
        <input type="text" name="nom" placeholder="Entrez le nom :"><br><br>
        Chercher par spécialité : <br>
        <select name="specialite" >
            <option value=""></option>
            <?php
                $id = mysqli_connect("127.0.0.1","root", "", "hopital");
                mysqli_query($id,"SET NAMES 'utf8");
                $requete = "select distinct specialite from medecins order by specialite";
                $reponse = mysqli_query($id, $requete);
                while($ligne = mysqli_fetch_assoc($reponse))
                {
                    echo "<option>".$ligne["specialite"]."</option>";
                }
            ?>
        </select><br><br>
        <input type="text" name="service" placeholder="Entrez le service :"><br><br>
        <input type="submit" value="Envoyer" name="recherche" ><br><br>
        
    </form>

    <hr>

    <?php
    if(isset($_POST["recherche"]))
    {
        $nom = $_POST["nom"];
        $specialite = $_POST["specialite"];
        $service = $_POST["service"];
        $requete2 = "select * from medecins
                    where nom like '%$nom%'
                    and service like '%$service%'";
        if(!empty($specialite))
        {
            $requete2 = "select * from medecins
                        where nom like '%$nom%'
                        and specialite = '$specialite'
                        and service like '%$service%'";
        }
        $res = mysqli_query($id,$requete2);

        while($ligne2 = mysqli_fetch_assoc($res))
        {
            echo "<div class='res'".$ligne2["nom"]." ".$ligne2["prenom"]." ".$ligne2["specialite"]." ".$ligne2["service"]."hr";
        }
    }

?>
</body>
</html>