<?php
//initialisation des variables sessions
session_start();

//recupération de la variable bdd
Require('pdo.php');    
global $bdd;

                   // on teste si l'utilisateur a cliquer une le boutton submit qui a comme nom :form
                   
                   if (isset($_POST['compte'])){
                   header("location: compte_create.php");
                   }



                   if (isset($_POST['form']))
                    {
                     // vérification si les variables id et mdp existe et non vide  
                     if(isset($_POST['mdp']) and isset($_POST['id']) and !empty($_POST['id']) and !empty($_POST['mdp'])){
                     
                       //récupération du champ id saisir par l'utilisateur et la fonction htmlspecial chars nous permet de concidérer tout le text saisie par l'utilisateur comme du text,pour qu'en cas ou un utilisateur mal veillant esseyras d'injecter un script php dans le champ id , cette fonction empechras l'execution du scripte en le concidérons comme symple texte 
                       $id = htmlspecialchars($_POST['id']);
                       
                       

                       // récupération du champ mdp saisie par l'utilisateur et le hacher avec la fonction sha1.
                       $mdp = sha1($_POST['mdp']);
       
                     
                            //récupération des lignes dans notre bdd dans la table user qui ont le user_name et mdp saisis par l'utilisateur.   
                            $r = $bdd->prepare("SELECT * FROM user WHERE user_name = ? AND mdp = ?");
                            
                            //executer cette requette en insérant les deux valeur saisie par l'utilisateur 
                            $r->execute(array($id,$mdp));
                            
                            //en compte le nombre de ligne qui répond a notre requete du dessu
                            $ex= $r->rowcount();
                   

                              //dans le cas ou on trouve une ligne qui corespond au valeur saisie par l'utilisateur donc la variable ex sera différente de 0, donc la condition if sera activer car l'utilisateur a présent est autantifier                  
                              if ($ex > 0) 
                              {
                              
                              echo('1');
                              $userinfo = $r->fetch();
                              
                              //on utilise les variables sessions pour enregistrer les données de lutilisateur dans ces dernières et pour définir le statuts de notre session s'il est on ou off.
                              $_SESSION['statuts'] = 1;
                              $_SESSION['nom'] =  $userinfo['user_name'];

                               //rediriger l'utilisateur a la page d'acceuil de la platforme admin avec la variable msg1 qui permetras d'afficher par la suite un message de bienvenue a l'espace admin et que l'autentification est réussite.
                               header("location: espace_admin.php?msg2=0");
                               
                               }
                              else
                              {
                              echo('2');
                              //rediriger l'utilisateur a la page d'autentification avec la variable msg1 qui permetras d'afficher par la suite un message d'erreur qui affichera que soit le mdp ou le id sont incorrecte. 
                              header("location: index.php?msg1=0"); 
                                 
                              }
                             
                         }   
                    }

                    //vérification si l'utilisateur a bien soumis le formulaire de création de compte
                    if (isset($_POST['form2'])) {
                      
                     //vérifier si les champ de mot de passe et confirmation de mot de passe sont édentique sinon la requete sera rédiriger vers la platforme de creation de compte avec un message d'erreur  
                    if ($_POST['1mdp']!=$_POST['2mdp']) {
                        header("location: compte_create.php?msg3=0"); 
                              
                      }else{
                        
                            //insertion du nouveau compte dans la bdd
                            $r = $bdd->prepare("INSERT INTO `user`(`user_name`, `mdp`) VALUES (?,?) ");
                            
                            //executer cette requette en insérant les deux valeur saisie par l'utilisateur 
                            $r->execute(array($_POST['id2'],sha1($_POST['1mdp'])));
                             
                             //rediriction de l'utilisateur vers l'index.php
                             header("location: index.php?msg4=0"); 
                              



                      }
                    }

?> 
