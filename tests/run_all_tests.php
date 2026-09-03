<?php

$basePath = dirname(__DIR__);
$phpBin = "C:\\laragon\\bin\\php\\php-8.3.33-Win32-vs16-x64\\php.exe";
if (!file_exists($phpBin)) {
    $phpBin = "php";
}

$testFiles = [
    "FoundationTest.php",
    "PublicWebsiteTest.php",
    "PricingEngineTest.php",
    "BookingEngineTest.php",
    "AdminAndAuthTest.php",
    "InvoiceAndPodTest.php",
    "CouponsAndCsvImportTest.php",
];

echo "====================================================\n";
echo "  RUSHPARCEL — FULL AUTOMATED TEST REGRESSION SUITE \n";
echo "====================================================\n\n";

$totalExecuted = 0;
$totalFailedSuites = 0;

foreach ($testFiles as $file) {
    $filePath = $basePath . "/tests/" . $file;
    if (!file_exists($filePath)) {
        echo "[FAIL] Missing test file: {$file}\n";
        $totalFailedSuites++;
        continue;
    }

    $cmd = "\"{$phpBin}\" \"{$filePath}\"";
    $output = [];
    $returnCode = 0;
    exec($cmd, $output, $returnCode);

    $outText = implode("\n", $output);
    echo $outText . "\n";

    if ($returnCode !== 0) {
        $totalFailedSuites++;
    }
    $totalExecuted++;
}

echo "====================================================\n";
if ($totalFailedSuites === 0) {
    echo "  ALL {$totalExecuted} TEST SUITES PASSED CLEANLY! (100% REGRESSION PASS)\n";
    echo "====================================================\n";
    exit(0);
} else {
    echo "  {$totalFailedSuites} OUT OF {$totalExecuted} TEST SUITES FAILED.\n";
    echo "====================================================\n";
    exit(1);
}

