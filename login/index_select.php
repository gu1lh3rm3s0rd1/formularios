<?php 
//Inicia a sessão conferindo se o usuário fez login
session_start(); 
if (!isset($_SESSION['logon']) or $_SESSION['logon'] == 0){header("Location: /FORMS/login/index.php");}?>

<?php if (!isset($_SESSION['funcionario']) or $_SESSION['funcionario'] == 0 or $_SESSION['funcionario'] == ''){
   header("Location: /FORMS/login/index.php");}?>

<!--Documento HTML-->
<!DOCTYPE html>
<html lang="pr-br">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="css/index_card.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>PAINEIS</title>
      <link rel="stylesheet" href="https://assets6.lottiefiles.com/packages/lf20_xQ5mGa6FH3.json">
   </head>
   <script language=javascript>
function confirmacao(){
 if (confirm("Deseja mesmo sair? Sua sessão será desconectada."))
    window.location.href = "/FORMS/login/index.php";
}
</script>
<body>

   <!--Função que define os paineis de acesso como cinza ou azul-->
   <script>
      function animation(){
         document.getElementById("1-acess").classList.add("cardbord");
         setTimeout(() => {       
            document.getElementById("1-acess").classList.remove("cardbord"); 
         }, 0600);

         document.getElementById("2-acess").classList.add("cardbord");
         setTimeout(() => {      
            document.getElementById("2-acess").classList.remove("cardbord");
         }, 0600);

         document.getElementById("3-acess").classList.add("cardbord");
         setTimeout(() => {       
            document.getElementById("3-acess").classList.remove("cardbord");
         }, 0600);

         document.getElementById("4-acess").classList.add("cardbord");
         setTimeout(() => {       
            document.getElementById("4-acess").classList.remove("cardbord");
         }, 0600);
      }

      //Funções para estilizar animações dos paineis em manutenção e desenvolvimento
      function alerta1(){
         document.getElementById("d1").classList.replace("cardn", "card3");
         setTimeout(() => {document.getElementById("d1").classList.replace("card3", "cardn"); }, 0500);
      }

      function alerta2(){
         document.getElementById("d2").classList.replace("cardn", "card2");
         setTimeout(() => {document.getElementById("d2").classList.replace("card2", "cardn");}, 0500);
      }

      function alerta3(){
         document.getElementById("d3").classList.replace("cardn", "card2");
         setTimeout(() => {document.getElementById("d3").classList.replace("card2", "cardn");}, 0500);
      }

      function alerta4(){
         document.getElementById("d4").classList.replace("cardn", "card2");
         setTimeout(() => {document.getElementById("d4").classList.replace("card2", "cardn");}, 0500);
      }

      function alerta5(){
         document.getElementById("d5").classList.replace("cardn", "card2");
         setTimeout(() => {document.getElementById("d5").classList.replace("card2", "cardn");}, 0500);
      }

      function alerta6(){
         document.getElementById("d6").classList.replace("cardn", "card2");
         setTimeout(() => {document.getElementById("d6").classList.replace("card2", "cardn");}, 0500);
      }

      function alerta7(){
         document.getElementById("d7").classList.replace("cardn", "card2");
         setTimeout(() => {document.getElementById("d7").classList.replace("card2", "cardn");}, 0500);
      }

      function alerta8(){
         document.getElementById("d8").classList.replace("cardn", "card2");
         setTimeout(() => {document.getElementById("d8").classList.replace("card2", "cardn");}, 0500);
      }

      //Função para bloquear os cards em que o usuário não tem acesso
      function block2(){
         document.getElementById("2").style.display = "none";
         document.getElementById("2-block").style.display = "block";
         setTimeout(() => {       
            document.getElementById("2").style.display = "block";
            document.getElementById("2-block").style.display = "none"; 
         }, 2200);
      }

      function block1(){
         document.getElementById("1").style.display = "none";
         document.getElementById("1-block").style.display = "block";
         setTimeout(() => {       
            document.getElementById("1").style.display = "block";
            document.getElementById("1-block").style.display = "none"; 
         }, 2200);
      }

      function block3(){
         document.getElementById("3").style.display = "none";
         document.getElementById("3-block").style.display = "block";
         setTimeout(() => {       
            document.getElementById("3").style.display = "block";
            document.getElementById("3-block").style.display = "none"; 
         }, 2200);
      }

      function block4(){
         document.getElementById("4").style.display = "none";
         document.getElementById("4-block").style.display = "block";
         setTimeout(() => {       
            document.getElementById("4").style.display = "block";
            document.getElementById("4-block").style.display = "none"; 
         }, 2200);
      }

      //Função para animação de carregamento dos paineis
      function carga(){
         document.getElementById("xiii").classList.add('preencher');
         setTimeout(() => {  
         document.getElementById("all").style.display = "none";
         document.getElementById("carga").style.display = "block";
         document.getElementById("botao-end").style.display = "none";
         document.getElementById("bth").style.display = "none";
         document.getElementById("botao-charge").style.display = "block";
         document.getElementById("c1").style.display = "block";
         setTimeout(() => {       
         document.getElementById("c2").style.display = "block";
         document.getElementById("c1").style.display = "none";
         setTimeout(() => {       
         document.getElementById("c3").style.display = "block";
         document.getElementById("c2").style.display = "none";
         document.getElementById("c1").style.display = "none";
         setTimeout(() => {       
         document.getElementById("c4").style.display = "block";
         document.getElementById("c3").style.display = "none";
         document.getElementById("c2").style.display = "none";
         setTimeout(() => {       
         document.getElementById("c5").style.display = "block";
         document.getElementById("c4").style.display = "none";
         document.getElementById("c3").style.display = "none";
         setTimeout(() => {       
         document.getElementById("c6").style.display = "block";
         document.getElementById("c5").style.display = "none";
         document.getElementById("c4").style.display = "none";
         setTimeout(() => {       
         document.getElementById("c7").style.display = "block";
         document.getElementById("c6").style.display = "none";
         document.getElementById("c5").style.display = "none";
         setTimeout(() => {       
         document.getElementById("c8").style.display = "block";
         document.getElementById("c7").style.display = "none";
         document.getElementById("c6").style.display = "none";
         }, 1000);}, 2000);}, 1000);}, 2800);}, 1000);}, 2800);
         }, 2800); }, 0700);
      }
   </script>

   <div class="niwm" id="xiii"></div>

   <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

   <main id="all">
      <div class="space"></div>
      <div class="ajuste">
         <img src="img/logo-chiaperini.png" class="img-top" id="logo" href="index.html">
         <label class="textt">CENTRAL DE GERENCIAMENTO</label>
         <lottie-player class="grow" src="https://assets6.lottiefiles.com/packages/lf20_nGCWSJ18xa.json" background="transparent"  speed="1" style="width: 70px; height: 35px;" autoplay></lottie-player>
      </div>
      <br>
         
      <div class="escala">
         <!---------------------------------------------INÍCIO CARDS DISPONÍVEIS------------------------------------------------->
         <main>
            <!--CARD 1-->
            <?php 
               if ($_SESSION['ENGENHARIA'] == 1){
                     $_SESSION['logon'] = 1;
                     echo
                     '<div id="1-acess" class="card1">
                     <a href="/FORMS/ENGENHARIA/index.php" onclick="carga()">
                        <span class="card1s"></span>
                        <span class="text-solt">
                        <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                     </svg>
                           <br>
                        <p>ENGENHARIA</p>
                        <div class="card1hover">
                        </div>
                        </span>  
                     </a>
                     </div>';
               } else {
                     echo '<a href="#" onclick="block1()">
                     <div onclick="animation()" class="cardn" id="1">
                     <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                     <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                     </svg>
                     <p>ENGENHARIA</p>
                     </div>
                     </a>
                     <a href="#">
                        <div style="display: none;" onclick="animation()" class="cardn" id="1-block">
                           <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                           <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                           </svg>
                              <br>
                           <p>ACESSO NEGADO</p>
                           <div class="card1hover">
                           </div>
                           </span>  
                        </div>
                        </a>';
               }
            ?>

            <!--CARD 2-->
            <?php 
               if ($_SESSION['FERRAMENTARIA'] == 1){
                     echo
                     '<div id="2-acess" class="card1">
                     <a href="/FORMS/FERRAMENTARIA/index.php" onclick="carga()">
                     <span class="card1s"></span>
                     <span class="text-solt">
                     <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                     <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0Zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708ZM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11Z"/>
                  </svg>
                     <p>FERRAMENTARIA</p>
                     <div class="card1hover">
                     </div>
                     </span>  
                  </a>
                  </div>';
               }else{
                  echo '<a href="#" onclick="block2()">
                  <div onclick="animation()" class="cardn" id="2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                  <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0Zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708ZM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11Z"/>
                  </svg>
                     <p>FERRAMENTARIA</p>
                  </div>
                  </a>
                  <a href="#">
                  <div style="display: none;" onclick="animation()" class="cardn" id="2-block">
                     <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                     <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                     </svg>
                        <br>
                     <p>ACESSO NEGADO</p>
                  </div>
                  </a>';
               }
            ?>

<?php 
               if ($_SESSION['MARKETING'] == 1){
                  echo
                  '<div id="4-acess" class="card1">
                  <a href="/FORMS/MARKETING/index.php" onclick="carga()">
                  <span class="card1s"></span>
                  <span class="text-solt">
                     <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-receipt-cutoff" viewBox="0 0 16 16">
                     <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zM11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
                     <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293 2.354.646zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118l.137-.274z"/>
                     </svg>
                     <br>
                  <p>MARKETING</p>
                  <div class="card1hover">
                  </div>
                  </span>  
                  </a>
                  </div>';
               }else{
                  echo '<a href="#" onclick="block4()">
                  <div onclick="animation()" class="cardn" id="4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-receipt-cutoff" viewBox="0 0 16 16">
                  <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zM11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
                  <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293 2.354.646zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118l.137-.274z"/>
                  </svg>
                     <br>
                     <p>MARKETING</p>
                  </div>
                  </a>
                  <a href="#">
                  <div style="display: none;" onclick="animation()" class="cardn" id="4-block">
                     <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                     <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                     </svg>
                     <br>
                     <p>ACESSO NEGADO</p>
                  </div>
                  </a>';
               }
            ?>

            <!--CARD 3-->
            <?php 
               if ($_SESSION['MANUTENÇÃO'] == 1){
                  echo
                  '<div id="3-acess" class="card1"> 
                  <a href="/FORMS/MANUTENCAO/index.php" onclick="carga()">
                  <span class="card1s"></span>
                  <span class="text-solt">
                  <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-clipboard-data-fill" viewBox="0 0 16 16">
                  <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z"/>
                  <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1ZM10 8a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V8Zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1Zm4-3a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z"/>
                  </svg>
                        <br>
                     <p>MANUTENÇÃO</p>
                     <div class="card1hover">
                     </div>
                  </span>  
                  </a>   
                  </div>';
               }else{
                  echo '<a href="#" onclick="block3()">
                  <div onclick="animation()" class="cardn" id="3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-clipboard-data-fill" viewBox="0 0 16 16">
                  <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z"/>
                  <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1ZM10 8a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V8Zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1Zm4-3a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z"/>
                  </svg>
                        <br>
                     <p>MANUTENÇÃO</p>
                  </div>
                  </a>
                  <a href="#">
                  <div style="display: none;" onclick="animation()" class="cardn" id="3-block">
                     <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                     <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                     </svg>
                     <br>
                     <p>ACESSO NEGADO</p>
                  </div>
                  </a>';
               }
            ?>

            <!--CARD 4-->
           
         </main>
         <!------------------------------------------------FIM CARDS DISPONÍVEIS------------------------------------------------->
      </div>
      <br><br>

   </main>

   <!--ANIMAÇÃO LOADING #################################################################################################-->

   <main id="carga" style="display: none;">
      <div class="ctr master"><script class="junior" src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script> 
         <lottie-player src="https://lottie.host/d2d25253-3c2f-436d-8abf-23a244ac1603/r6O8VesiU1.json" background="transparent" speed="1" style="width: 140px; height: 140px;" loop autoplay></lottie-player></lottie-player>
         <h1 class="carregando">CARREGANDO...</h1>
      </div>
   </main>
   <br><br>

   <main id="botao-end">
      <a href="#" onclick="return confirmacao()" class="sair">
         <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 12">
            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
         </svg> SAIR
      </a>
   </main>
   <br><br>

   <main style="display: none;" id="botao-charge">
      <p id="c1" style="display: none; color: #1E90FF;">Por favor, aguarde <br></br> 
         <svg style="color: #1E90FF;" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z"/>
            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z"/>
         </svg>
      </p>

      <p id="c2" style="display: none; color: #728c9b;">Consultando dados <br></br> 
         <svg style="color: #728c9b;" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
            <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
            <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
         </svg>
      </p>

      <p id="c3" style="display: none; color: #007bc2;">Consultando dados <br></br> 
         <svg style="color: #007bc2;" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cloud-check" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10.354 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
            <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
         </svg>
      </p>

      <p id="c4" style="display: none; color: #728c9b;">Importando Gráficos <br></br> 
         <svg style="color: #728c9b;" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-file-earmark-bar-graph-fill" viewBox="0 0 16 16">
            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm.5 10v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1z"/>
         </svg>
      </p>

      <p id="c5" style="display: none; color: #007bc2;">Importando Gráficos <br></br> 
         <svg style="color: #007bc2;" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-file-earmark-check-fill" viewBox="0 0 16 16">
            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm1.354 4.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
         </svg>
      </p>

      <p id="c6" style="display: none; color: #728c9b;">Ajustando Layout <br></br> 
         <svg style="color: #728c9b;" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-journal-arrow-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5z"/>
            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
         </svg>
      </p>

      <p id="c7" style="display: none; color: #007bc2;">Ajustando Layout <br></br> 
         <svg style="color: #007bc2;" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-journal-check" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
         </svg>
      </p>

      <p id="c8" style="display: none; color :#1E90FF;">Carregando Painel... <br></br> 
         <svg style="color :#1E90FF;" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
         </svg>
      </p>
      <br><br>

      <a href="index_all.php" class="botao btn-sg"> Cancelar </a>
   </main>

   <div style="margin: auto; text-align: center; opacity: 0.6;">  
      <i><?php echo 'LOGADO COMO: '; ?><b><?php echo ' '.$_SESSION['funcionario'];?></b></i><br>
      <i><?php echo 'CÓDIGO DE USUÁRIO: '; ?><b><?php echo ' '.$_SESSION['cod_funcionario'];?></b></i><br><br>
      <i><?php echo 'EMPRESA: '; ?><b><?php echo ' '.$_SESSION['empresa'];?></b></i>
   </div>

   <!--VERIFICA A QUAIS PAINEIS O CLIENTE TEM ACESSO (EM TODAS AS COMBINAÇÕES DISPONÍVEIS DE ORDEM DOS ACESSOS) E OCULTA OS QUE ELE NÃO TEM #####################################################-->
</body>
</html>