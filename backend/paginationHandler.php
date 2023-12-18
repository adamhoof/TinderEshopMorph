<?php

/**
 * Handles pagination for displaying user transactions.
 *
 * This script includes functions for calculating page counts,
 * generating pagination controls, and displaying paginated data.
 */

include_once "database.php";
include_once "checkUserValidity.php";
include_once "user.php";
include_once "fetchUserTransactionsPage.php";

/**
 * Calculates the total number of pages for transactions.
 *
 * @param User $user The user whose transactions are counted.
 * @param int $pageSize The number of transactions per page.
 * @return int Total number of pages.
 */
function getPageCount(User $user, int $pageSize): int
{
    return ceil(fetchAllUserTransactionsCount($user) / $pageSize);
}

/**
 * Generates pagination controls.
 *
 * @param int $pageCount Total number of pages.
 * @param int $requestedPage The current page number.
 */
function generatePagination(int $pageCount, int $requestedPage): void
{
    $start = 1;
    if ($pageCount <= 7) {
        $end = $pageCount;
    } else {
        $end = 7;
        $pageNeighborhood = 3;

        if ($requestedPage > $pageNeighborhood) {
            $mid = $requestedPage;
            $start = $mid - $pageNeighborhood;
            $end = $mid + $pageNeighborhood;
        }
        if ($requestedPage >= $pageCount - $pageNeighborhood) {
            $start = $pageCount - 6;
            $end = $pageCount;
        }
    }

    echo '<div id="pagination_wrapper">';
    for ($i = $start; $i <= $end && $i <= $pageCount; $i++) {
        if ($i == $requestedPage)
            echo "<input type='submit' name='page' value='$i' class='active'>";
        else
            echo "<input type='submit' name='page' value='$i'>";
    }
    echo '</div>';
}

/**
 * Displays paginated transaction data for a user.
 *
 * @param User $user The user whose transactions are displayed.
 * @param int $requestedPage The current page number.
 */

function generatePaginatedData(User $user, int $requestedPage): void
{
    $numRows = 5;
    $transactionsPage = getTransactionHistoryPage($user, $numRows, $requestedPage);
    for ($i = 0; $i < $numRows; $i++) {
        $transaction = $transactionsPage[$i] ?? null;
        if (!isset($transaction)) break;
        echo "<tr>";
        echo "<td>" . htmlspecialchars($transaction->name) . "</td>";
        echo "<td>" . htmlspecialchars($transaction->sellerId) . "</td>";
        echo "<td>" . htmlspecialchars($transaction->price) . "</td>";
        echo "<td>" . htmlspecialchars($transaction->date) . "</td>";
        echo "</tr>";
    }
}