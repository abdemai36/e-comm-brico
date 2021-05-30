<?php
    include_once('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Functions/function.php');

    $query="SELECT * FROM marque_tb";
    $result=mysqli_query($conx,$query);
?>

                <div class="head-marque">
                    <h1 class="text-center title-h">Tous Les marques</h1>
                </div>
                <form action="" method="GET">
                    <div class="table-responsive">
                        <table class="table mt-3 table-bordered align-middle table-hover">
                                <tr>
                                    <th>ID marque</th>
                                    <th>Nom marque</th>
                                    <th>Image marque</th>
                                    <th>contrôler</th>
                                </tr>
                                <?php 
                                    while($ro=mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>".$ro[0]."</td>";
                                        echo "<td>".$ro[1]."</td>";
                                        echo "<td><img class='img-marque' src='avatar/".$ro[2]."'/></td>";
                                        echo "<td class='controls'> 
                                                <a href='Edit_Marque.php?id=".$ro[0]."' class='btn btn-info btn-Norespons'>Modifier</a>  
                                                <a href='Edit_Marque.php?id=".$ro[0]."' class='btn btn-info btn-respons'><i class='far fa-edit'></i></a>  
                                                <a href='delete_m.php?id=".$ro[0]."' class='btn btn-danger btn-Norespons' >Supprimer</a> 
                                                <a href='delete_m.php?id=".$ro[0]."' class='btn btn-danger btn-respons'><i class='far fa-trash-alt'></i></a> 

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