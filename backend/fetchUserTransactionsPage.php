<?php

/**
 * Provides functionality to fetch a specific page of a user's transaction history.
 *
 * This script includes the database file and defines a function to fetch a
 * paginated section of a user's transaction history.
 */

include_once "database.php";

/**
 * Fetches a specific page of a user's transaction history.
 *
 * @param User $user The user whose transactions are being fetched.
 * @param int $numRows The number of rows per page.
 * @param int $pageNumber The page number to fetch.
 * @return array Array of transactions for the specified page.
 */
function getTransactionHistoryPage(User $user, int $numRows, int $pageNumber): array
{
    return fetchUserTransactions($user, $numRows, ($pageNumber - 1) * $numRows);
}