<footer>
    <?php
    $custom = "";
    $extraPluginFile = $global['systemRootPath'] . 'plugin/Customize/Objects/ExtraConfig.php';
    if (file_exists($extraPluginFile) && YouPHPTubePlugin::isEnabled("c4fe1b83-8f5a-4d1b-b912-172c608bf9e3")) {
        require_once $extraPluginFile;
        $ec = new ExtraConfig();
        $custom = $ec->getFooter();
    }
    if (empty($custom)) {
        ?>
        <ul class="list-inline">
            <li>
                Powered by <a href="http://www.youphptube.com" class="external btn btn-outline btn-primary btn-xs" target="_blank">YouPHPTube LLC v
                </a>
            </li>
            <li>
                <a href="https://www.facebook.com/classcloud/" class="external btn btn-outline btn-primary btn-xs" target="_blank"><span class="sr-only">Facebook</span><i class="fab fa-facebook-square"></i></a>
            </li>
            <li>
                <a href="https://twitter.com/ClassCloudCa" class="external btn btn-outline btn-primary btn-xs" target="_blank"><span class="sr-only">Twitter</span><i class="fab fa-twitter-square"></i></a>
            </li>
        </ul>
        <?php
    } else {
        echo $custom;
    }
    ?>
</footer>
<script>
    window.onerror = function myErrorHandler(errorMsg, url, lineNumber) {
        if (url == "") {
            url = "embed in html";
        }
        $.ajax({
            url: webSiteRootURL + "objects/ajaxErrorCatcher.php?error=" + encodeURI("JS-Err: " + errorMsg + " @ line " + lineNumber + " in file " + url + " at visit on <?php echo $_SERVER['REQUEST_URI']; ?>"),
            context: document.body
        }).done(function () {
            console.log("<?php echo 'A Javascript-error happend. Please tell your admin to clear the folder videos/cache. \r\n If this doesn\'t help, attach these infos to a github-pull-request:'; ?> \r\n Msg:" + errorMsg + " \r\n Url: " + url + ", line: " + lineNumber + ", Address: <?php echo $_SERVER['REQUEST_URI'] ?>");
        });
        return false;
    }

    // Just for testing
    // throw "A Bug";
    $(function () {
<?php
if (!empty($_GET['error'])) {
    ?>
            swal({title: "Sorry!", text: "<?php echo $_GET['error']; ?>", type: "error", html: true});
    <?php
}
?>
<?php
if (!empty($_GET['msg'])) {
    ?>
            swal({title: "Ops!", text: "<?php echo $_GET['msg']; ?>", type: "info", html: true});
    <?php
}
?>
    });
</script>
<!-- <script src="<?php echo $global['webSiteRootURL']; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->
<?php
$jsFiles = array();
$jsFiles[] = "view/bootstrap/js/bootstrap.min.js";
$jsFiles[] = "view/js/seetalert/sweetalert.min.js";
$jsFiles[] = "view/js/bootpag/jquery.bootpag.min.js";
$jsFiles[] = "view/js/bootgrid/jquery.bootgrid.js";
$jsFiles[] = "view/bootstrap/bootstrapSelectPicker/js/bootstrap-select.min.js";
$jsFiles[] = "view/js/script.js";
//$jsFiles[] = "view/js/bootstrap-toggle/bootstrap-toggle.min.js";
$jsFiles[] = "view/js/js-cookie/js.cookie.js";
$jsFiles[] = "view/css/flagstrap/js/jquery.flagstrap.min.js";
$jsFiles[] = "view/js/jquery.lazy/jquery.lazy.min.js";
$jsFiles[] = "view/js/jquery.lazy/jquery.lazy.plugins.min.js";
$jsFiles[] = "view/js/webui-popover/jquery.webui-popover.min.js";
$jsFiles[] = "view/js/bootstrap-list-filter/bootstrap-list-filter.min.js";
if (!empty($video['type'])) {

    $waveSurferEnabled = YouPHPTubePlugin::getObjectDataIfEnabled("CustomizeAdvanced");
    if ($waveSurferEnabled == false) {
        $waveSurferEnabled = true;
    } else {
        $waveSurferEnabled = $waveSurferEnabled->EnableWavesurfer;
    }
    if ((($video['type'] == "audio") || ($video['type'] == "linkAudio")) && ($waveSurferEnabled)) {
        $jsFiles[] = "view/js/videojs-wavesurfer/wavesurfer.min.js";
        $jsFiles[] = "view/js/videojs-wavesurfer/dist/videojs.wavesurfer.min.js";
    }
}
$jsFiles = array_merge($jsFiles, YouPHPTubePlugin::getJSFiles());
$jsURL = combineFiles($jsFiles, "js");
?>
<script src="<?php echo $jsURL; ?>" type="text/javascript"></script>
<?php
require_once $global['systemRootPath'] . 'plugin/YouPHPTubePlugin.php';
?>
<div id="pluginFooterCode">
    <?php
    echo YouPHPTubePlugin::getFooterCode();
    ?>
</div>
<?php
if (isset($_SESSION['savedQuerys'])) {
    echo "<!-- Saved querys: " . $_SESSION['savedQuerys'] . " -->";
}
?>
<textarea id="elementToCopy" style="
          filter: alpha(opacity=0);
          -moz-opacity: 0;
          -khtml-opacity: 0;
          opacity: 0;
          position: absolute;
          z-index: -9999;
          top: 0;
          left: 0;
          pointer-events: none;"></textarea>
