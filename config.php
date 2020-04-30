<?php

include ("../../inc/includes.php");
include ("../../inc/config.php");
Session::checkLoginUser();

if (!defined("GLPI_MOD_DIR")) {
   define("GLPI_MOD_DIR", GLPI_ROOT."/plugins/livechat");
}

$plugin = new Plugin();

                                                            
//Enable Disable
function lvOff(){
    rename('livechat.js', 'example.js');
    Html::redirect($CFG_GLPI["root_doc"]  . "../../front/plugin.php");
}

function lvOn(){
    rename('example.js', 'livechat.js');
    Html::redirect($CFG_GLPI["root_doc"]  . "../../front/plugin.php");
}

                                                            
//URL
function urlW($server, $port){
    $script_livechat = explode("\n",file_get_contents('livechat.js'));
    $script_livechat[3] = "j.async = true; j.src = 'http://".$server.":".$port."/livechat/rocketchat-livechat.min.js?_=201903270000';";
    $script_livechat[5] = "})(window, document, 'script', 'http://".$server.":".$port."/livechat');";
    
    $arquivo = fopen('livechat.js','r+');
    
    rewind($arquivo);
    
    ftruncate($arquivo, 0);
    
    if (!fwrite($arquivo, implode($script_livechat))) die('Não foi possível atualizar o script.');
    echo 'Script atualizado com sucesso';
    fclose($arquivo);
}

  
if ($plugin->isActivated("livechat")){
    if(isset($_REQUEST['act'])) {
        $action = $_REQUEST['act'];
    }
    else { $action = '';}

    Html::header('Plugin Livechat', "", "plugins", "livechat");

    echo "<div class='center' style='height:1100px; width:80%; background:#fff; margin:auto; float:none;'><br><p>\n";
    echo "<div id='config' class='center here ui-tabs-panel'>
                    <br><p>
                    <span style='color:blue; font-weight:bold; font-size:13pt;'>".__('Plugin Livechat')."</span> <br><br><p>\n";

    echo "<div style='text-align: left;'><p><strong>Para adicionar seu livechat no GLPI siga as instruções abaixo:</strong></p>
    <p>1. Acesse o diretorio <code>livechat</code>, dentro de <code>plugins</code> no seu servidor GLPI <br>
    2. Abra o arquivo livechat/livechat.js <br>
    3. Altere os dados de IP e porta, conforme o seu servidor Rocket.chat <br>
    4. Se estiver usando outro serviço de livechat, substitua todo o seu conteudo pelo conteúdo do script do seu servidor<br>
    5. Por fim, clique no botão <code>habilitar</code></p></div>";
    
                    /*
    // URL Livechat
    echo "<table class='tab_cadrehov' border='0'>
    <tbody>\n";
    echo "<tr>
            <td colspan='1' width='70'>".__('Dados do servidor livechat').": </td>\n";
    echo "                          
            <td width='50'>
                    <form action='config.php?act=urlW' method='post'> ";
                    
    echo "                  <input class='input' type='text' name='servidor' />";
                    
    echo "  </td>\n";

    echo "  <td width='200'>
                    ";
                    
    echo "                  <input class='input' type='number' name='porta' />";

    echo "  </td>";

    echo "  <td width='200'>
    ";
    
    echo "                  <input class='submit' type='submit' name='submit' value='".__('Send')."' />";

        Html::closeForm();
    echo "  </td>
    </tr>\n";

    */

    // Ativar/desativar plugin
    echo "<table style='text-align: left;' class='tab_cadrehov' border='0'> <tbody>\n";
    echo "<tr>
            <td colspan='1' width='50'>".__('Livechat').": </td>\n";
    if (file_exists("example.js")){
        echo "                          
            <td width='50'>
                    <form action='config.php?act=lvdon' method='post'> ";
                    if ($action == 'lvdon') {
                            lvOn();
                    }
    echo "                  <input class='submit' type='submit' value='"._x('button','Enable')."' />";
                    Html::closeForm();
    echo "  </td>\n";

    } elseif (file_exists('livechat.js')){
        echo "  <td  style='text-align: left;' width='50'>
                    <form action='config.php?act=lvoff' method='post'> ";
                    if ($action == 'lvoff') {
                            lvOff();
                    }
    echo "                  <input class='submit' type='submit' value='".__('Disable')."' />";
                    Html::closeForm();
    echo "  </td>";
   

    }
    echo "</tr>\n";
    
    




}