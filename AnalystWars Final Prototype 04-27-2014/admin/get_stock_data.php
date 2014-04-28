<?php
include_once('../inc/db_connect.php');
include_once('../inc/functions.php');

sec_session_start();

$searchedSymbol = $_POST["stockTicker"];

$startDate = $_POST["startDate"];
$endDate = $_POST["endDate"];

error_log("symbol searched: " . $searchedSymbol);
error_log("start date: " . $startDate);
error_log("end date: " . $endDate);
$appended_url = "?status=";
if(is_null($searchedSymbol))
{
	$appended_url = $appended_url."false";
	header("Location: table_responsive.php");
}
else if ($startDate == "" || $endDate == "")
{
	error_log("else if reached");
	
	$yql_query_url = "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22". $searchedSymbol . "%22)&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=";
	
	
	
	$session = curl_init($yql_query_url);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	$json = curl_exec($session);
	$phpObj = json_decode($json);
	
	
	if(!is_null($phpObj->query->results->quote->StockExchange))
	{
		//Data has been returned from function call
		$quote = $phpObj->query->results->quote;
		
		$stockSymbol = $quote->Symbol;
		$stockDate = $quote->LastTradeDate;
		$openPrice = $quote->Open;
		$highPrice = $quote->DaysHigh;
		$closePrice = $quote->PreviousClose;
		$volume = $quote->Volume;
		$priceChange = $quote->Change;
		$percentageChange = $quote->PercentChange;
		$eps = $quote->EarningsShare;
		$askRealTime = $quote->AskRealtime;
                $stockName = $quote->Name;
		//Placeholder for revenue variable $revenue = $quote->?;
		
		$stockDate = explode("/",$stockDate);
		$year = $stockDate[2];
		$month = $stockDate[0];
		$day = $stockDate[1];
		
		$formatted_date = $year . "-" . $month . "-" . $day;
		
		
		//Insert to table
		if ($insert_stmt = $mysqli->prepare("INSERT INTO stock (stockSymbol, stockDate, openPrice, highPrice, closePrice, volume, priceChange, percentageChange, EPS)
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) 
								ON DUPLICATE KEY UPDATE stockSymbol=?, stockDate=?, openPrice=?, highPrice=?, closePrice=?, volume=?, priceChange=?,
								percentageChange=?, EPS=?")){
								
		$insert_stmt->bind_param('ssdddddddssddddddd', $stockSymbol, $formatted_date, $openPrice, $highPrice, $closePrice, $volume, $priceChange, $percentageChange, $eps,
					 $stockSymbol, $formatted_date, $openPrice, $highPrice, $closePrice, $volume, $priceChange, $percentageChange, $eps);
		$insert_stmt->execute();
		//echo "Insertion to Stock Table successful!";
		$_SESSION['stockTicker'] = $stockSymbol;
		header("Location: ./table_responsive.php");
		}
		else{
			echo "Invalid database command!";
		}
	}
	
	else
	{
		//No data was returned from function call
		$appended_url = $appended_url."false";
		header("Location: table_responsive.php");
	}
}
else			//start and end date
{
	error_log("else reached");
	/*
	$yql_query_url = "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%20in%20(%22". $searchedSymbol . "%22)%20and%20startDate%20%3D%20%22" . $startDate . "%22%20and%20endDate%20%3D%20%22" . $endDate . "%22%20and&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=";
	*/
	
	$yql_query_url = "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%20=%20%22" . $searchedSymbol . "%22%20and%20startDate%20=%20%22" . $startDate . "%22%20and%20endDate%20=%20%22" . $endDate . "%22&format=json&diagnostics=true&env=store://datatables.org/alltableswithkeys";
	
	error_log($yql_query_url);
	
	$startDateEXPLODE = explode("-",$startDate);
	$endDateEXPLODE = explode("-",$endDate);
	$nDays = "";
	
	
	
	$session = curl_init($yql_query_url);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	$json = curl_exec($session);
	$phpObj = json_decode($json);
	
	error_log(count($phpObj));
	
	if(!is_null($phpObj->query->results->quote->Date))
	{
		//Data has been returned from function call
		$quote = $phpObj->query->results->quote;
		
		for ($i = 0; $i < count($quote); $i++)
		{
			$stockSymbol = $quote->Symbol;
			$stockDate = $quote->LastTradeDate;
			$openPrice = $quote->Open;
			$highPrice = $quote->DaysHigh;
			$closePrice = $quote->PreviousClose;
			$volume = $quote->Volume;
			$priceChange = $quote->Change;
			$percentageChange = $quote->PercentChange;
			$eps = $quote->EarningsShare;
			$askRealTime = $quote->AskRealtime;
                        $stockName = $quote->Name;
			//Placeholder for revenue variale $revenue = $quote->?;
			
			$stockDate = explode("/",$stockDate);
			$year = $stockDate[2];
			$month = $stockDate[0];
			$day = $stockDate[1];
			
			$formatted_date = $year . "-" . $month . "-" . $day;
		}
		
		
		//Insert to table
		if ($insert_stmt = $mysqli->prepare("INSERT INTO stock (stockSymbol, stockDate, openPrice, highPrice, closePrice, volume, priceChange, percentageChange, EPS)
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) 
								ON DUPLICATE KEY UPDATE stockSymbol=?, stockDate=?, openPrice=?, highPrice=?, closePrice=?, volume=?, priceChange=?,
								percentageChange=?, EPS=?")){
								
		$insert_stmt->bind_param('ssdddddddssddddddd', $stockSymbol, $formatted_date, $openPrice, $highPrice, $closePrice, $volume, $priceChange, $percentageChange, $eps,
					 $stockSymbol, $formatted_date, $openPrice, $highPrice, $closePrice, $volume, $priceChange, $percentageChange, $eps);
		$insert_stmt->execute();
		//echo "Insertion to Stock Table successful!";
		$_SESSION['stockTicker'] = $stockSymbol;
                $_SESSION['stockName'] = $stockName;
                error_log("PHP Variable: " . $stockName);
                error_log("Session Variable: " . $_SESSION['stockName']);
		header("Location: ./table_responsive.php");
		}
		else{
			echo "Invalid database command!";
		}
	}
	
	else
	{
		//No data was returned from function call
		$appended_url = $appended_url."false";
		header("Location: http://yql.bornfreefinancial.com/stock_search.php".$appended_url);
	}
}

?>