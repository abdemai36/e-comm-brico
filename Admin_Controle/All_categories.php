<?php
    include('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Functions/function.php');

    $query="SELECT * FROM categorie_tb";
    $result=mysqli_query($conx,$query);
?>

                <div class="head-categori">
                    <h1 class="text-center title-h">Tous Les catégoriess</h1>
                </div>
                <form action="" method="GET">
                <div class="table-responsive">
                        <table class="table mt-3 table-bordered table-responsive table-hover">
                                <tr>
                                    <th>ID catégorie</th>
                                    <th>Nom Catégorie</th>
                                    <th>contrôler</th>
                                </tr>
                                <?php 
                                    while($ro=mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>".$ro[0]."</td>";
                                        echo "<td>".$ro[1]."</td>";
                                        echo "<td> 
                                                <a href='Edit_categories.php?id=".$ro[0]."' class='btn btn-info btn-Norespons'>Modifier</a>
                                                <a href='Edit_categories.php?id=".$ro[0]."' class='btn btn-info btn-respons'><i class='far fa-edit'></i></a>  
                                                <a href='delete_categories.php?id=".$ro[0]."' class='btn btn-danger btn-Norespons' name='del'>Supprimer</a> 
                                                <a href='delete_categories.php?id=".$ro[0]."' class='btn btn-danger btn-respons' name='del'><i class='far fa-trash-alt'></i></a> 
                                            </td>";
                                        echo "</tr>";
                                    }
                                ?>
                        </table>
                    </div>
                </form>


<?php
    include_once('Includes/Templates/footer.php');
?>