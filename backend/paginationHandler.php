<?php

include_once "database.php";
include_once "checkUserValidity.php";
include_once "user.php";
include_once "fetchUserTransactionsPage.php";
function getPageCount(User $user, $pageSize): int
{
    return ceil(fetchAllUserTransactionsCount($user) / $pageSize);
}
function generatePagination($pageCount, $requestedPage): void
{
    $start = 1;
    if ($pageCount <= 7) {
        $end = $pageCount;
    } else {
        $end = 7;
        $pageNeighborhood = 3;

        if (isset($requestedPage) && $requestedPage > $pageNeighborhood) {
            $mid = $requestedPage;
            $start = $mid - $pageNeighborhood;
            $end = $mid + $pageNeighborhood;
        }
        if (isset($requestedPage) && $requestedPage >= $pageCount - $pageNeighborhood) {
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

function generatePaginatedData(User $user, $requestedPage): void
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