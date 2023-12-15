<?php

include_once "database.php";

function getTransactionHistoryPage(User $user, $numRows, $pageNumber): array
{
    return fetchUserTransactions($user, $numRows, ($pageNumber - 1) * $numRows);
}
