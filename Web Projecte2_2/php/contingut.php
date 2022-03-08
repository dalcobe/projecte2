<?php
    include 'phps.php';
    session_start();
    connexioBD();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="contingut2.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cabin:ital@1&family=Lobster&family=Patrick+Hand&display=swap%27');
    </style>
    <script src="javas.js"></script>
    <title>DAMA</title>
</head>
<body>
    <section>
        <header>
            <a href="#" class="logo">Dama</a>
            <!-- S'executa l'script d'abaix per a que quan se faci clic al menu s'obri i es pugui tancar-->
            <div class="Menu" onclick="Menu();"></div>
            <!-- Menu de navegacio de l'usuari -->
            <ul class="navegador">
                <li><a href="Perfil.php">Perfil</a></li>
                <li><a href="HistorialActivitats.php">Historial Act</a></li>
                <li><a href="../xml/curses.xml">Curses</a></li>
                <li><a href="../index.html">Tancar Sessió</a></li>
            </ul>
        </header>
        <main>
            <div class="benvingut">
                <h2> Benvingut/da <?php echo $_SESSION['usuari'] ?></h2>
            </div>
            <div class="aforament">
                <h2>Aforament del gimnas</h2>

            </div>
            <h2>Cataleg d'activitats</h2>
            <h3>Activitats Lliures</h3>
            <div class="activitats">
                <div class="contenidor">
                    <?php

                        $sql= "SELECT A.imatge, A.nomActivitat, A.hora, S.aforament, M.nom, A.numero_sala, A.ID
                        from activitats A, sales S, monitors M where A.numero_sala = S.num_sala 
                        and S.num_sala = M.sala_numero and A.ID = (select *
                                                                from activitat_lliure S2
                                                                where A.ID = S2.IDL)
                        order by imatge";
                        $result = connexioBD()->query($sql);                        

                        if ($result->num_rows > 0){

                            while($row = $result->fetch_assoc()){
                                $ID = $row["ID"];
                                $imatge = $row["imatge"];
                                $nomActivitat = $row["nomActivitat"];
                                $hora = $row["hora"];
                                $aforament = $row["aforament"];
                                $nom = $row["nom"];
                                $num_sala = $row["numero_sala"];
                                echo " <div class='activitat'>
                                <div class='grid-container'>
                                    <div class='imatge'>
                                        <img src='$imatge'/>
                                    </div>
                                    <div class='nom_act'>
                                        <p>Nom de l'activitat: <b>$nomActivitat</b></p>
                                    </div>
                                    <div class='hora'>
                                        <p>Hora de l'activitat: <b>$hora</b></p>
                                    </div>
                                    <div class='aforament'>
                                        <p>Aforament de la sala: <b>$aforament</b></p>
                                    </div>
                                    <div class='nom_moni'>
                                        <p>Nom del monitor: <b>$nom</b></p>
                                    </div>
                                    <div class='sala'>
                                        <p>Sala: <b>$num_sala</b></p>
                                    </div>
                                    <div class='boto'>
                                    <input id='reserva' type='button' value='Reserva' onclick='insertarActivitat($ID);'>
                                    <input id='anul·lar' type='submit' value='Anul·lar' onclick='eliminarReserva($ID);'>
                                    </div>
                                    
                                        </div>
                                </div>";
                            }
                        }
                        

                    ?>
                </div>
            </div>    

            <h3 class="colectives">Activitats Col·lectives</h3>
            <div class="activitats2">
                <div class="contenidor2">
                    <?php
                        $sql="SELECT A.imatge, A.nomActivitat, A.hora, S.aforament, M.nom, A.numero_sala, A.ID
                        from activitats A, sales S, monitors M where A.numero_sala = S.num_sala 
                        and S.num_sala = M.sala_numero and A.ID = (select *
                                                                from activitat_colectiva S2
                                                                where A.ID = S2.IDC)
                        order by imatge";
                        $result = connexioBD()->query($sql);                       

                        if ($result->num_rows > 0){

                            while($row = $result->fetch_assoc()){
                                $ID = $row["ID"];
                                $imatge = $row["imatge"];
                                $nomActivitat = $row["nomActivitat"];
                                $hora = $row["hora"];
                                $aforament = $row["aforament"];
                                $nom = $row["nom"];
                                $num_sala = $row["numero_sala"];
                                echo " <div class='activitat'>
                                <div class='grid-container'>
                                    <div class='imatge'>
                                        <img src='$imatge'/>
                                    </div>
                                    <div class='nom_act'>
                                        <p>Nom de l'activitat: <b>$nomActivitat</b></p>
                                    </div>
                                    <div class='hora'>
                                        <p>Hora de l'activitat: <b>$hora</b></p>
                                    </div>
                                    <div class='aforament'>
                                        <p>Aforament de la sala: <b>$aforament</b></p>
                                    </div>
                                    <div class='nom_moni'>
                                        <p>Nom del monitor: <b>$nom</b></p>
                                    </div>
                                    <div class='sala'>
                                        <p>Sala: <b>$num_sala</b></p>
                                    </div>
                                    <div class='boto'>
                                    <input id='reserva' type='button' value='Reserva' onclick='insertarActivitat($ID);'>
                                    <input id='anul·lar' type='submit' value='Anul·lar' onclick='eliminarReserva($ID);'>
                                    </div>
                                    
                                        </div>
                                </div>";
                            }
                        }





                    ?>
                </div>                
            </div>
            </main>

        
        <!-- Titol del gimnas i descripció -->
        <footer>
        <ul class="sci">
            <li><a href="https://es-es.facebook.com/"><img src="IMG/facebook.png"></a></li>
            <li><a href="https://twitter.com/?lang=es"><img src="IMG/twitter.png"></a></li>
            <li><a href="https://www.instagram.com/?hl=es"><img src="IMG/instagram.png"></a></li>
        </ul>
        </footer>  
    </section>
    <!-- Script per quan se estigui en mobil, se pugui obri i tancar el menu desplegable -->
    <script type="text/javascript">
        function Menu(){
            const Menu = document.querySelector('.Menu');
            const navegador = document.querySelector('.navegador');
            Menu.classList.toggle('active');
            navegador.classList.toggle('active');
        }

        function insertarActivitat(id_Activitat){
            $.ajax({
            url: "insertarActivitat.php?id_client=<?php echo $_SESSION["DNI"]; ?>&id_activitat="+id_Activitat,
            }).done(function(msg){
                Swal.fire(
                    'Reserva Feta!',
                    'Prem OK per confirmar',
                    'success'
                );
            // TODO: Accions per informar al browser de que s'ha insertat l'activitat
            }).fail(function(error){ 
                alert('Error');
            });
        }

        function eliminarReserva(id_Activitat){
            $.ajax({
            url: "eliminarReserva.php?id_client=<?php echo $_SESSION["DNI"]; ?>&id_activitat="+id_Activitat,
            }).done(function(msg){
                Swal.fire(
                    'Reserva Elimanada!',
                    'Prem OK per confirmar',
                    'success'
                );
            // TODO: Accions per informar al browser de que s'ha insertat l'activitat
            }).fail(function(error){ 
                alert('Error');
            });
        }

    </script>
</body>
</html>