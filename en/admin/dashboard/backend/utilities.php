<?php
// Utility functions for number formatting and calculations

/**
 * Calculate percentage change between two values
 * @param float $new_value
 * @param float $old_value
 * @return float
 */
function calculatePercentageChange($new_value, $old_value) {
    $new_value = $new_value ?? 0;
    $old_value = $old_value ?? 0;
    if ($old_value == 0) return 0;
    return round((($new_value - $old_value) / $old_value) * 100, 1);
}

/**
 * Format large numbers with k/m/b suffix
 * @param float $number
 * @return string
 */
function formatLargeNumber($number) {
    $number = $number ?? 0;
    if ($number >= 1000000000) {
        return round($number/1000000000, 1) . 'b';
    }
    if ($number >= 1000000) {
        return round($number/1000000, 1) . 'm';
    }
    if ($number >= 1000) {
        return round($number/1000, 1) . 'k';
    }
    return number_format($number);
}

/**
 * Format money values
 * @param float $amount
 * @return string
 */
function formatMoney($amount) {
    $amount = $amount ?? 0;
    return '$' . number_format($amount, 2);
}

/**
 * Format percentage values
 * @param float $value
 * @return string
 */
function formatPercentage($value) {
    return round($value, 1) . '%';
}

/**
 * Format date to a readable string
 * @param string $date
 * @return string
 */
function formatDate($date) {
    return date('M j, Y', strtotime($date));
}
?> 