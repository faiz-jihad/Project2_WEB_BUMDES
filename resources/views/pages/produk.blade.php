@extends('layouts.master')

@section('title', 'Produk Kami - BUMDes Madusari')

@section('content')
<br><br><br>
<style>
    /* =======================================
   SHOPEE-STYLE CSS - BUMDes Madusari
   ======================================= */

/* =======================================
   GLOBAL RESETS & UTILITIES
======================================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    background-color: #f5f5f5;
    color: #222;
    line-height: 1.5;
}

img {
    max-width: 100%;
    display: block;
    height: auto;
}

button {
    cursor: pointer;
    border: none;
    background: none;
    font-family: inherit;
    font-size: inherit;
}

input, select, textarea {
    font-family: inherit;
    font-size: inherit;
}

a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s ease;
}

a:hover {
    color: #0d9121;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

:root {
    --orange: #097e13;
    --orange-dark: #0c832a;
    --orange-light: #fff6f5;
    --gray-dark: #222;
    --gray-medium: #555;
    --gray-light: #888;
    --gray-bg: #f5f5f5;
    --gray-border: #e8e8e8;
    --blue: #05a;
    --success: #00bfa5;
    --warning: #ffb300;
    --danger: #ff5252;
    --shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
    --shadow-hover: 0 2px 5px 0 rgba(0, 0, 0, 0.1);
    --shadow-heavy: 0 4px 12px 0 rgba(0, 0, 0, 0.15);
    --transition: all 0.2s ease;
    --border-radius: 2px;
    --border-radius-sm: 4px;
    --border-radius-lg: 8px;
}

.btn {
    display: inline-block;
    padding: 8px 16px;
    border-radius: var(--border-radius);
    font-weight: 400;
    text-align: center;
    cursor: pointer;
    transition: var(--transition);
    border: 1px solid transparent;
    font-size: 14px;
}

.btn-success {
    background: var(--orange);
    color: white;
    border-color: var(--orange);
}

.btn-success:hover {
    background: var(--orange-dark);
    border-color: var(--orange-dark);
    color: white;
    transform: translateY(-1px);
    box-shadow: var(--shadow-hover);
}

.btn-outline-secondary {
    background: white;
    color: var(--gray-medium);
    border-color: rgba(0, 0, 0, 0.09);
}

.btn-outline-secondary:hover {
    background: #f5f5f5;
    border-color: rgba(0, 0, 0, 0.26);
}

.text-center {
    text-align: center;
}

.text-muted {
    color: var(--gray-light);
}

.mb-3 {
    margin-bottom: 1rem;
}

.mb-4 {
    margin-bottom: 1.5rem;
}

.mt-4 {
    margin-top: 1.5rem;
}

/* =======================================
   HERO SECTION (Shopee Style)
======================================= */
.hero-section {
    padding: 40px 0;
    background: linear-gradient(180deg, #12a537, rgb(8, 128, 52));
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 30px;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M1200 120L0 16.48 0 0 1200 0 1200 120z' fill='%23f5f5f5'/%3E%3C/svg%3E") no-repeat;
    background-size: 100% 100%;
    z-index: 1;
}

.hero-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 10px;
    position: relative;
    z-index: 2;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
}

.hero-subtitle {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 30px;
    position: relative;
    z-index: 2;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 40px;
    flex-wrap: wrap;
    position: relative;
    z-index: 2;
    margin-top: 30px;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: #fff;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    display: block;
    line-height: 1;
}

.stat-label {
    display: block;
    margin-top: 8px;
    opacity: 0.9;
    font-size: 0.9rem;
    font-weight: 400;
}

/* =======================================
   MODERN FILTERS & SEARCH (Shopee Style)
======================================= */
.filters-section {
    margin: 20px 0;
    background: white;
    border-radius: var(--border-radius);
    padding: 16px;
    box-shadow: var(--shadow);
    border: 1px solid rgba(0, 0, 0, 0.05);
    position: relative;
    z-index: 10;
}

/* Top Bar */
.filters-top-bar {
    margin-bottom: 20px;
}

.search-sort-group {
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
}

/* Enhanced Search */
.search-container {
    flex: 1;
    min-width: 300px;
}

.search-input-wrapper {
    position: relative;
    background: white;
    border: 1px solid rgba(0, 0, 0, 0.14);
    border-radius: var(--border-radius);
    box-shadow: inset 0 2px 0 rgba(0, 0, 0, 0.02);
    overflow: hidden;
    transition: var(--transition);
}

.search-input-wrapper:focus-within {
    border-color: var(--orange);
    box-shadow: 0 0 0 1px rgba(238, 77, 45, 0.2);
}

.search-input {
    width: 100%;
    padding: 12px 40px 12px 16px;
    border: none;
    font-size: 14px;
    background: transparent;
    outline: none;
}

.search-input::placeholder {
    color: var(--gray-light);
}

.search-icon {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-light);
    font-size: 16px;
    pointer-events: none;
}

.clear-search {
    position: absolute;
    right: 40px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-light);
    font-size: 14px;
    padding: 2px;
    border-radius: 50%;
    transition: var(--transition);
    display: none;
    background: white;
    border: none;
    cursor: pointer;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.clear-search:hover {
    background: #f5f5f5;
    color: var(--orange);
}

.search-input:not(:placeholder-shown) ~ .clear-search {
    display: flex;
}

/* Sort Dropdown */
.sort-container {
    position: relative;
}

.sort-dropdown {
    position: relative;
}

.sort-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 10px 12px;
    background: white;
    border: 1px solid rgba(0, 0, 0, 0.09);
    border-radius: var(--border-radius);
    font-size: 14px;
    font-weight: 400;
    cursor: pointer;
    transition: var(--transition);
    min-width: 150px;
    color: var(--gray-dark);
}

.sort-btn:hover {
    border-color: var(--orange);
    background-color: var(--orange-light);
}

.sort-dropdown.open .sort-btn {
    border-color: var(--orange);
    background-color: var(--orange-light);
}

.sort-menu {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid rgba(0, 0, 0, 0.09);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-heavy);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-5px);
    transition: var(--transition);
    z-index: 1000;
    margin-top: 2px;
}

.sort-dropdown.open .sort-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.sort-option {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 12px;
    cursor: pointer;
    transition: var(--transition);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    font-size: 14px;
    color: var(--gray-dark);
}

.sort-option:last-child {
    border-bottom: none;
}

.sort-option:hover {
    background: var(--orange-light);
    color: var(--orange);
}

.sort-option.active {
    background: var(--orange-light);
    color: var(--orange);
    font-weight: 500;
}

.sort-option i {
    width: 16px;
    text-align: center;
    color: var(--orange);
}

/* View Toggle */
.view-toggle {
    display: flex;
    border: 1px solid rgba(0, 0, 0, 0.09);
    border-radius: var(--border-radius);
    overflow: hidden;
    background: white;
}

.view-btn {
    padding: 10px 12px;
    background: white;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-medium);
    min-width: 40px;
}

.view-btn.active {
    background: #f5f5f5;
    color: var(--orange);
}

.view-btn:not(.active):hover {
    background: #f9f9f9;
    color: var(--orange);
}

.view-btn i {
    font-size: 16px;
}

/* Filter Toggle Button */
.filter-toggle-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 10px 16px;
    background: white;
    color: var(--gray-dark);
    border: 1px solid rgba(0, 0, 0, 0.09);
    border-radius: var(--border-radius);
    font-weight: 400;
    transition: var(--transition);
    font-size: 14px;
}

.filter-toggle-btn:hover {
    background: #f9f9f9;
    border-color: var(--orange);
    color: var(--orange);
}

.filter-toggle-btn i {
    font-size: 14px;
    color: var(--orange);
}

.filter-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 18px;
    height: 18px;
    background: var(--orange);
    color: white;
    border-radius: 9px;
    font-size: 11px;
    font-weight: 500;
    margin-left: 4px;
}

/* =======================================
   CATEGORY PILLS (Shopee Style)
======================================= */
.category-filters {
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.category-scroll {
    display: flex;
    gap: 8px;
    overflow-x: auto;
    padding-bottom: 8px;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.category-scroll::-webkit-scrollbar {
    display: none;
}

.category-pill {
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 8px 12px;
    background: white;
    border: 1px solid rgba(0, 0, 0, 0.09);
    border-radius: 15px;
    font-size: 13px;
    font-weight: 400;
    color: var(--gray-medium);
    transition: var(--transition);
    white-space: nowrap;
    flex-shrink: 0;
    cursor: pointer;
}

.category-pill:hover {
    border-color: var(--orange);
    color: var(--orange);
}

.category-pill.active {
    background: var(--orange);
    border-color: var(--orange);
    color: white;
}

.category-pill i {
    font-size: 12px;
}

.pill-count {
    background: #f5f5f5;
    color: var(--gray-medium);
    padding: 1px 6px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 400;
    margin-left: 2px;
}

.category-pill.active .pill-count {
    background: rgba(255, 255, 255, 0.3);
    color: white;
}

/* =======================================
   FILTER SIDEBAR (Shopee Style)
======================================= */
.filter-sidebar {
    position: fixed;
    top: 0;
    right: -320px;
    width: 320px;
    height: 100vh;
    background: white;
    box-shadow: -2px 0 8px rgba(0, 0, 0, 0.15);
    transition: var(--transition);
    z-index: 1050;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
}

.filter-sidebar.open {
    right: 0;
}

.filter-sidebar-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    background: white;
    position: sticky;
    top: 0;
    z-index: 1;
}

.filter-sidebar-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 500;
    color: var(--gray-dark);
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-sidebar-header h3 i {
    color: var(--orange);
}

.close-filter {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-medium);
    transition: var(--transition);
    font-size: 14px;
    border: none;
    cursor: pointer;
    background: transparent;
}

.close-filter:hover {
    background: #f5f5f5;
    color: var(--gray-dark);
}

.filter-sidebar-content {
    padding: 20px;
    flex: 1;
    overflow-y: auto;
}

.filter-group {
    margin-bottom: 24px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.filter-group:last-child {
    margin-bottom: 0;
    border-bottom: none;
    padding-bottom: 0;
}

.filter-group-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    font-size: 14px;
    font-weight: 500;
    color: var(--gray-dark);
}

.filter-group-header i {
    color: var(--orange);
    width: 18px;
    font-size: 14px;
}

/* Price Range */
.price-range-inputs {
    display: flex;
    align-items: center;
    gap: 8px;
}

.price-input-group {
    flex: 1;
}

.price-input-group label {
    display: block;
    font-size: 12px;
    font-weight: 400;
    color: var(--gray-medium);
    margin-bottom: 6px;
}

.price-input {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid rgba(0, 0, 0, 0.14);
    border-radius: var(--border-radius);
    font-size: 13px;
    transition: var(--transition);
    outline: none;
}

.price-input:focus {
    border-color: var(--orange);
    box-shadow: 0 0 0 1px rgba(238, 77, 45, 0.2);
}

.price-separator {
    color: var(--gray-medium);
    font-weight: 400;
    font-size: 14px;
    padding-top: 20px;
}

/* Stock Status */
.stock-status-options {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.status-option {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    border: 1px solid rgba(0, 0, 0, 0.09);
    border-radius: var(--border-radius);
    transition: var(--transition);
    cursor: pointer;
    font-size: 13px;
}

.status-option:hover {
    border-color: var(--orange);
    background: var(--orange-light);
}

.status-option.active {
    border-color: var(--orange);
    background: var(--orange-light);
}

.status-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.status-indicator.available {
    background: var(--success);
}

.status-indicator.low {
    background: var(--warning);
}

.status-indicator.out {
    background: var(--danger);
}

.status-text {
    font-size: 13px;
    font-weight: 400;
    color: var(--gray-dark);
    flex: 1;
}

/* Active Filters */
.active-filters {
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    padding-top: 20px;
    margin-top: 20px;
}

.active-filters-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}

.active-filters-header span {
    font-size: 14px;
    font-weight: 500;
    color: var(--gray-dark);
}

.clear-all-filters {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    color: var(--orange);
    transition: var(--transition);
    text-decoration: none;
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px;
}

.clear-all-filters:hover {
    color: var(--orange-dark);
}

.active-filters-list {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    min-height: 30px;
}

.filter-tag {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 6px 10px;
    background: var(--orange-light);
    border: 1px solid var(--orange);
    border-radius: var(--border-radius);
    font-size: 12px;
    color: var(--orange-dark);
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.filter-tag span {
    font-weight: 400;
}

.remove-filter {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--orange-dark);
    transition: var(--transition);
    font-size: 10px;
    border: none;
    background: transparent;
    cursor: pointer;
    padding: 0;
}

.remove-filter:hover {
    background: var(--orange);
    color: white;
}

.filter-sidebar-footer {
    position: sticky;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 20px;
    background: white;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    display: flex;
    gap: 10px;
    box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.05);
}

.filter-sidebar-footer .btn {
    flex: 1;
    padding: 10px;
    border-radius: var(--border-radius);
    font-weight: 400;
    transition: var(--transition);
    font-size: 14px;
    text-align: center;
    cursor: pointer;
}

.filter-sidebar-footer .btn-outline-secondary {
    border: 1px solid rgba(0, 0, 0, 0.09);
    color: var(--gray-medium);
    background: white;
}

.filter-sidebar-footer .btn-outline-secondary:hover {
    background: #f5f5f5;
    border-color: rgba(0, 0, 0, 0.26);
}

.filter-sidebar-footer .btn-success {
    background: var(--orange);
    border: 1px solid var(--orange);
    color: white;
}

.filter-sidebar-footer .btn-success:hover {
    background: var(--orange-dark);
    border-color: var(--orange-dark);
}

/* Filter Overlay */
.filter-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
    opacity: 0;
    visibility: hidden;
    transition: var(--transition);
    z-index: 1040;
}

.filter-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* =======================================
   PRODUCTS GRID (Shopee Style)
======================================= */
.products-container {
    margin: 20px 0 40px;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
    transition: var(--transition);
}

.products-grid.list-view {
    grid-template-columns: 1fr;
    gap: 20px;
}

/* =======================================
   PRODUCT CARD (Shopee Style)
======================================= */
.product-card {
    background: white;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
    position: relative;
    border: 1px solid rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    height: 100%;
    cursor: pointer;
}

.product-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-hover);
    border-color: rgba(0, 0, 0, 0.12);
    z-index: 1;
}

/* IMAGE AREA */
.product-image {
    position: relative;
    height: 200px;
    overflow: hidden;
    background: #f5f5f5;
    flex-shrink: 0;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: var(--transition);
    padding: 15px;
}

.product-card:hover img {
    transform: scale(1.05);
}

/* DISCOUNT BADGE */
.discount-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(255, 212, 36, 0.9);
    color: #ee4d2d;
    padding: 3px 6px;
    border-radius: var(--border-radius);
    font-size: 12px;
    font-weight: 600;
    z-index: 2;
    line-height: 1;
}

/* STOCK BADGE */
.stock-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 3px 6px;
    border-radius: var(--border-radius);
    font-size: 11px;
    font-weight: 500;
    color: white;
    z-index: 2;
    line-height: 1;
}

.in-stock {
    background: rgba(0, 191, 165, 0.9);
}

.low-stock {
    background: rgba(255, 179, 0, 0.9);
}

.out-of-stock {
    background: rgba(255, 82, 82, 0.9);
}

/* QUICK ACTIONS */
.product-actions {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    z-index: 2;
    opacity: 0;
    transform: translateX(10px);
    transition: var(--transition);
}

.product-card:hover .product-actions {
    opacity: 1;
    transform: translateX(0);
}

.action-btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: white;
    color: var(--gray-medium);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: none;
    cursor: pointer;
    font-size: 14px;
}

.action-btn:hover {
    background: var(--orange);
    color: white;
    transform: scale(1.1);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
}

/* OVERLAY */
.product-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
    opacity: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    z-index: 1;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.view-details-btn {
    padding: 10px 20px;
    background: var(--orange);
    border-radius: 20px;
    color: white;
    font-weight: 500;
    text-decoration: none;
    transition: var(--transition);
    font-size: 14px;
    border: none;
    cursor: pointer;
}

.view-details-btn:hover {
    background: var(--orange-dark);
    transform: scale(1.05);
}

/* INFO AREA */
.product-info {
    padding: 15px;
    flex: 1;
    display: flex;
    flex-direction: column;
    background: white;
}

.product-category {
    font-size: 11px;
    color: var(--gray-light);
    font-weight: 400;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    line-height: 1;
}

.product-title {
    margin-bottom: 8px;
    flex-shrink: 0;
}

.product-title a {
    font-size: 14px;
    font-weight: 400;
    color: var(--gray-dark);
    text-decoration: none;
    transition: var(--transition);
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 40px;
}

.product-title a:hover {
    color: var(--orange);
}

.product-description {
    font-size: 12px;
    color: var(--gray-medium);
    line-height: 1.5;
    margin-bottom: 12px;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* PRICE & STOCK */
.product-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
    flex-shrink: 0;
}

.current-price {
    font-size: 16px;
    font-weight: 500;
    color: var(--orange);
    line-height: 1;
}

.product-stock-info {
    font-size: 12px;
    color: var(--gray-medium);
    display: flex;
    align-items: center;
    gap: 4px;
}

.product-stock-info i {
    font-size: 12px;
}

/* RATING & SOLD */
.product-rating-sold {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 8px;
    padding-top: 8px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    flex-shrink: 0;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: 4px;
}

.stars {
    display: flex;
    gap: 1px;
}

.stars i {
    color: var(--warning);
    font-size: 11px;
}

.rating-score {
    font-size: 12px;
    color: var(--orange);
    font-weight: 500;
    margin-left: 2px;
}

.product-sold {
    font-size: 11px;
    color: var(--gray-medium);
}

/* FREE SHIPPING BADGE */
.free-shipping {
    background: var(--orange);
    color: white;
    font-size: 10px;
    padding: 2px 5px;
    border-radius: var(--border-radius);
    font-weight: 500;
    display: inline-block;
    margin-top: 8px;
    line-height: 1;
}

/* List View */
.products-grid.list-view .product-card {
    flex-direction: row;
    height: auto;
}

.products-grid.list-view .product-image {
    width: 200px;
    height: 200px;
    flex-shrink: 0;
}

.products-grid.list-view .product-info {
    padding: 20px;
    flex: 1;
}

.products-grid.list-view .product-title a {
    font-size: 16px;
    -webkit-line-clamp: 1;
}

.products-grid.list-view .product-description {
    -webkit-line-clamp: 3;
    font-size: 14px;
}

.products-grid.list-view .current-price {
    font-size: 18px;
}

/* =======================================
   NO PRODUCTS (Shopee Style)
======================================= */
.no-products {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.no-products-icon {
    font-size: 48px;
    color: #ccc;
    margin-bottom: 20px;
    opacity: 0.6;
}

.no-products h3 {
    font-size: 18px;
    color: var(--gray-dark);
    margin-bottom: 10px;
    font-weight: 500;
}

.no-products p {
    color: var(--gray-medium);
    margin-bottom: 25px;
    font-size: 14px;
    line-height: 1.6;
}

.no-products .btn {
    padding: 10px 30px;
    background: var(--orange);
    color: white;
    border-radius: var(--border-radius);
    text-decoration: none;
    font-weight: 400;
    transition: var(--transition);
    font-size: 14px;
    display: inline-block;
    border: 1px solid var(--orange);
}

.no-products .btn:hover {
    background: var(--orange-dark);
    border-color: var(--orange-dark);
    transform: translateY(-1px);
    box-shadow: var(--shadow-hover);
}

/* =======================================
   RESPONSIVE BREAKPOINTS
======================================= */
@media (max-width: 1200px) {
    .container {
        max-width: 100%;
        padding: 0 20px;
    }

    .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 12px;
    }
}

@media (max-width: 992px) {
    .hero-title {
        font-size: 1.8rem;
    }

    .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    }

    .search-container {
        min-width: auto;
        flex: 0 0 100%;
    }

    .search-sort-group {
        width: 100%;
        justify-content: space-between;
    }

    .filter-toggle-btn {
        order: 1;
    }

    .view-toggle {
        order: 2;
    }

    .sort-container {
        order: 3;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 0 15px;
    }

    .hero-section {
        padding: 30px 0 40px;
    }

    .hero-title {
        font-size: 1.6rem;
    }

    .hero-subtitle {
        font-size: 0.95rem;
        padding: 0 15px;
    }

    .hero-stats {
        gap: 25px;
    }

    .stat-number {
        font-size: 1.5rem;
    }

    .stat-label {
        font-size: 0.85rem;
    }

    .filters-section {
        padding: 15px;
        margin: 15px 0;
    }

    .products-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .products-grid.list-view .product-image {
        width: 150px;
        height: 150px;
    }

    .filter-sidebar {
        width: 300px;
        right: -300px;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 1.4rem;
    }

    .hero-subtitle {
        font-size: 0.9rem;
    }

    .hero-stats {
        flex-direction: row;
        justify-content: space-around;
        gap: 15px;
    }

    .stat-item {
        flex: 1;
    }

    .stat-number {
        font-size: 1.3rem;
    }

    .stat-label {
        font-size: 0.8rem;
    }

    .products-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
    }

    .product-image {
        height: 160px;
    }

    .products-grid.list-view .product-card {
        flex-direction: column;
    }

    .products-grid.list-view .product-image {
        width: 100%;
        height: 200px;
    }

</style>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">Produk Unggulan BUMDes Madusari</h1>
            <p class="hero-subtitle">Temukan berbagai produk berkualitas hasil karya masyarakat desa kami.</p>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $produk->count() }}</span>
                    <span class="stat-label">Produk</span>
                </div>
                @php
                    $kategoriCount = $produk->pluck('kategori')->unique()->filter()->count();
                @endphp
                <div class="stat-item">
                    <span class="stat-number">{{ $kategoriCount }}</span>
                    <span class="stat-label">Kategori</span>
                </div>
                @php
                    $stokTersedia = $produk->where('stok', '>', 0)->count();
                @endphp
                <div class="stat-item">
                    <span class="stat-number">{{ $stokTersedia }}</span>
                    <span class="stat-label">Tersedia</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters & Search Section -->
    <section class="filters-section">
        <div class="container">
            <!-- Top Bar -->
            <div class="filters-top-bar">
                <!-- Search Box -->
                @if (request('search'))
                    <div class="search-results mb-3">
                        <p>Menampilkan hasil pencarian untuk: "<strong>{{ request('search') }}</strong>"
                            <a href="{{ route('produk.index') }}" class="btn-clear-search">Tampilkan Semua</a>
                        </p>
                    </div>
                @endif

                <div class="search-sort-group">
                    <div class="search-container">
                        <div class="search-input-wrapper">
                            <i class="bi bi-search search-icon"></i>
                            <input type="text" class="search-input" id="produkSearch"
                                   placeholder="Cari produk..."
                                   value="{{ request('search') }}">
                            <button class="clear-search">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Sort Dropdown -->
                    <div class="sort-container">
                        <div class="sort-dropdown">
                            <button class="sort-btn">
                                <i class="bi bi-filter-left"></i>
                                <span>Urutkan</span>
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <div class="sort-menu">
                                <div class="sort-option" data-sort="nama">
                                    <i class="bi bi-sort-alpha-down"></i>
                                    <span>Nama A-Z</span>
                                </div>
                                <div class="sort-option" data-sort="nama_desc">
                                    <i class="bi bi-sort-alpha-up"></i>
                                    <span>Nama Z-A</span>
                                </div>
                                <div class="sort-option" data-sort="harga">
                                    <i class="bi bi-sort-numeric-down"></i>
                                    <span>Harga Terendah</span>
                                </div>
                                <div class="sort-option" data-sort="harga_desc">
                                    <i class="bi bi-sort-numeric-up"></i>
                                    <span>Harga Tertinggi</span>
                                </div>
                                <div class="sort-option" data-sort="stok">
                                    <i class="bi bi-box"></i>
                                    <span>Stok Terbanyak</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- View Toggle -->
                    <div class="view-toggle">
                        <button class="view-btn active" data-view="grid">
                            <i class="bi bi-grid-3x3-gap"></i>
                        </button>
                        <button class="view-btn" data-view="list">
                            <i class="bi bi-list"></i>
                        </button>
                    </div>

                    <!-- Filter Toggle -->
                    <button class="filter-toggle-btn" id="openFilterSidebar">
                        <i class="bi bi-funnel"></i>
                        <span>Filter</span>
                        <span class="filter-count" id="filterCount">0</span>
                    </button>
                </div>
            </div>

            <!-- Category Pills -->
            @php
                $kategoriList = $produk->pluck('kategori')->unique()->filter();
                $produkCounts = [];
                foreach ($produk as $item) {
                    $kategori = strtolower($item->kategori);
                    if (!empty($kategori)) {
                        $produkCounts[$kategori] = ($produkCounts[$kategori] ?? 0) + 1;
                    }
                }
            @endphp
            <div class="category-filters">
                <div class="category-scroll">
                    <div class="category-pill active" data-category="all">
                        <span>Semua</span>
                        <span class="pill-count">{{ $produk->count() }}</span>
                    </div>
                    @foreach ($kategoriList as $kategori)
                        @if ($kategori)
                            @php
                                $slug = strtolower($kategori);
                                $count = $produkCounts[$slug] ?? 0;
                            @endphp
                            <div class="category-pill" data-category="{{ $slug }}">
                                <i class="bi bi-tag"></i>
                                <span>{{ ucfirst($kategori) }}</span>
                                <span class="pill-count">{{ $count }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-container">
        <div class="container">
            <div class="products-grid" id="productsGrid">
                @forelse ($produk as $item)
                    <div class="product-card"
                         data-id="{{ $item->id }}"
                         data-slug="{{ $item->slug }}"
                         data-category="{{ strtolower($item->kategori) }}"
                         data-nama="{{ strtolower($item->nama) }}"
                         data-deskripsi="{{ strtolower($item->deskripsi) }}"
                         data-harga="{{ $item->harga }}"
                         data-stok="{{ $item->stok }}"
                         data-rating="4.5"
                         data-sold="120">
                        <!-- Image Area -->
                        <div class="product-image">
                            <a href="{{ route('produk.show', $item->slug) }}">
                                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/no-image.jpg') }}"
                                     alt="{{ $item->nama }}"
                                     loading="lazy">
                            </a>

                            @if ($item->stok == 0)
                                <div class="stock-badge out-of-stock">Habis</div>
                            @elseif ($item->stok < 10)
                                <div class="stock-badge low-stock">Terbatas</div>
                            @else
                                <div class="stock-badge in-stock">Tersedia</div>
                            @endif

                            <!-- Discount Badge (example) -->
                            @if($item->harga > 50000)
                                <div class="discount-badge">Promo</div>
                            @endif

                            <!-- Quick Actions -->
                            <div class="product-actions">
                                <button class="action-btn favorite-btn" title="Tambah ke Favorit">
                                    <i class="bi bi-heart"></i>
                                </button>
                                @if($item->stok > 0)
                                    <button class="action-btn cart-btn"
                                            title="Tambah ke Keranjang"
                                            data-id="{{ $item->id }}">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                @endif
                            </div>

                            <!-- Quick View Overlay -->
                            <div class="product-overlay">
                                <a href="{{ route('produk.show', $item->slug) }}" class="view-details-btn">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>

                        <!-- Info Area -->
                        <div class="product-info">
                            <div class="product-category">
                                {{ $item->kategori ?? 'Umum' }}
                            </div>
                            <div class="product-title">
                                <a href="{{ route('produk.show', $item->slug) }}">
                                    {{ $item->nama }}
                                </a>
                            </div>
                            <div class="product-description">
                                {{ Str::limit($item->deskripsi, 60) }}
                            </div>

                            <!-- Price & Stock -->
                            <div class="product-meta">
                                <div class="current-price">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </div>
                                <div class="product-stock-info">
                                    <i class="bi bi-box"></i>
                                    {{ $item->stok }} tersedia
                                </div>
                            </div>

                            <!-- Rating & Sold -->
                            <div class="product-rating-sold">
                                <div class="product-rating">
                                    <div class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= 4)
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star-half"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="rating-score">4.5</span>
                                </div>
                                <div class="product-sold">
                                    Terjual 120
                                </div>
                            </div>

                            <!-- Free Shipping Badge (example) -->
                            @if($item->harga > 100000)
                                <span class="free-shipping">Gratis Ongkir</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="no-products">
                        <div class="no-products-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h3>Belum ada produk yang tersedia</h3>
                        <p>Maaf, produk sedang tidak tersedia saat ini.</p>
                        @if (request('search'))
                            <a href="{{ route('produk.index') }}" class="btn btn-success">
                                Tampilkan Semua Produk
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Filter Sidebar -->
    <div class="filter-sidebar" id="filterSidebar">
        <div class="filter-sidebar-header">
            <h3><i class="bi bi-funnel"></i> Filter Produk</h3>
            <button class="close-filter" id="closeFilterSidebar">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="filter-sidebar-content">
            <!-- Price Range Filter -->
            <div class="filter-group">
                <div class="filter-group-header">
                    <i class="bi bi-currency-dollar"></i>
                    <span>Rentang Harga</span>
                </div>
                <div class="price-range-inputs">
                    <div class="price-input-group">
                        <label>Minimum</label>
                        <input type="number" class="price-input" id="minPrice"
                               placeholder="Rp 0" min="0">
                    </div>
                    <div class="price-separator">-</div>
                    <div class="price-input-group">
                        <label>Maksimum</label>
                        <input type="number" class="price-input" id="maxPrice"
                               placeholder="Rp 1.000.000" min="0">
                    </div>
                </div>
            </div>

            <!-- Stock Status Filter -->
            <div class="filter-group">
                <div class="filter-group-header">
                    <i class="bi bi-box"></i>
                    <span>Status Stok</span>
                </div>
                <div class="stock-status-options">
                    <div class="status-option" data-status="available">
                        <div class="status-indicator available"></div>
                        <span class="status-text">Tersedia</span>
                    </div>
                    <div class="status-option" data-status="low">
                        <div class="status-indicator low"></div>
                        <span class="status-text">Stok Terbatas</span>
                    </div>
                    <div class="status-option" data-status="out">
                        <div class="status-indicator out"></div>
                        <span class="status-text">Habis</span>
                    </div>
                </div>
            </div>

            <!-- Active Filters -->
            <div class="active-filters">
                <div class="active-filters-header">
                    <span>Filter Aktif</span>
                    <button class="clear-all-filters" id="clearAllFilters">
                        <i class="bi bi-trash"></i>
                        <span>Hapus Semua</span>
                    </button>
                </div>
                <div class="active-filters-list" id="activeFiltersList">
                    <!-- Active filters will appear here -->
                </div>
            </div>
        </div>

        <div class="filter-sidebar-footer">
            <button class="btn btn-outline-secondary" id="resetFilters">
                Reset
            </button>
            <button class="btn btn-success" id="applyFilters">
                Terapkan
            </button>
        </div>
    </div>

    <!-- Filter Overlay -->
    <div class="filter-overlay" id="filterOverlay"></div>

    <!-- Include Shopee CSS -->
    <link rel="stylesheet" href="{{ asset('css/shopee-style.css') }}">

    <style>
        /* Additional custom styles for product page */
        .search-results {
            background: #fff6f5;
            padding: 12px 16px;
            border-radius: 2px;
            border-left: 3px solid var(--orange);
            margin-bottom: 16px;
        }

        .search-results p {
            margin: 0;
            color: var(--gray-dark);
            font-size: 14px;
        }

        .btn-clear-search {
            color: var(--orange);
            text-decoration: none;
            font-weight: 500;
            margin-left: 8px;
            font-size: 14px;
        }

        .btn-clear-search:hover {
            text-decoration: underline;
        }

        /* Customize action buttons */
        .cart-btn {
            color: var(--orange);
        }

        .cart-btn:hover {
            background: var(--orange);
            color: white;
        }

        .favorite-btn:hover {
            background: #ff4757;
            color: white;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const produkCards = document.querySelectorAll('.product-card');
            const searchInput = document.getElementById('produkSearch');
            const clearSearchBtn = document.querySelector('.clear-search');
            const categoryPills = document.querySelectorAll('.category-pill');
            const filterSidebar = document.getElementById('filterSidebar');
            const openFilterBtn = document.getElementById('openFilterSidebar');
            const closeFilterBtn = document.getElementById('closeFilterSidebar');
            const filterOverlay = document.getElementById('filterOverlay');
            const viewButtons = document.querySelectorAll('.view-btn');
            const productsGrid = document.getElementById('productsGrid');
            const sortOptions = document.querySelectorAll('.sort-option');
            const sortDropdown = document.querySelector('.sort-dropdown');
            const sortBtn = document.querySelector('.sort-btn');
            const statusOptions = document.querySelectorAll('.status-option');
            const activeFiltersList = document.getElementById('activeFiltersList');
            const filterCount = document.getElementById('filterCount');
            const clearAllFiltersBtn = document.getElementById('clearAllFilters');
            const resetFiltersBtn = document.getElementById('resetFilters');
            const applyFiltersBtn = document.getElementById('applyFilters');
            const minPriceInput = document.getElementById('minPrice');
            const maxPriceInput = document.getElementById('maxPrice');

            // Active filters object
            let activeFilters = {
                category: 'all',
                search: '',
                minPrice: null,
                maxPrice: null,
                stockStatus: [],
                sortBy: null
            };

            // Initialize from URL parameters if any
            function initializeFromUrl() {
                const urlParams = new URLSearchParams(window.location.search);

                if (urlParams.has('search')) {
                    activeFilters.search = urlParams.get('search');
                    searchInput.value = activeFilters.search;
                }

                if (urlParams.has('category')) {
                    activeFilters.category = urlParams.get('category');
                    // Activate corresponding category pill
                    categoryPills.forEach(pill => {
                        if (pill.dataset.category === activeFilters.category) {
                            pill.classList.add('active');
                        } else if (pill.classList.contains('active')) {
                            pill.classList.remove('active');
                        }
                    });
                }

                updateFilterCount();
                filterProducts();
            }

            // Update filter count display
            function updateFilterCount() {
                let count = 0;

                if (activeFilters.category && activeFilters.category !== 'all') count++;
                if (activeFilters.search) count++;
                if (activeFilters.minPrice || activeFilters.maxPrice) count++;
                if (activeFilters.stockStatus.length > 0) count++;
                if (activeFilters.sortBy) count++;

                filterCount.textContent = count;
                filterCount.style.display = count > 0 ? 'flex' : 'none';
            }

            // Update active filters list
            function updateActiveFiltersList() {
                activeFiltersList.innerHTML = '';

                if (activeFilters.category && activeFilters.category !== 'all') {
                    const pill = document.querySelector(`.category-pill[data-category="${activeFilters.category}"]`);
                    if (pill) {
                        const categoryName = pill.querySelector('span:not(.pill-count)').textContent;
                        addActiveFilter('category', `Kategori: ${categoryName}`);
                    }
                }

                if (activeFilters.search) {
                    addActiveFilter('search', `Pencarian: "${activeFilters.search}"`);
                }

                if (activeFilters.minPrice) {
                    addActiveFilter('minPrice', `Min: Rp ${parseInt(activeFilters.minPrice).toLocaleString()}`);
                }

                if (activeFilters.maxPrice) {
                    addActiveFilter('maxPrice', `Max: Rp ${parseInt(activeFilters.maxPrice).toLocaleString()}`);
                }

                activeFilters.stockStatus.forEach(status => {
                    let statusText = '';
                    switch(status) {
                        case 'available': statusText = 'Tersedia'; break;
                        case 'low': statusText = 'Stok Terbatas'; break;
                        case 'out': statusText = 'Habis'; break;
                    }
                    addActiveFilter(`stock_${status}`, `Stok: ${statusText}`);
                });

                if (activeFilters.sortBy) {
                    let sortText = '';
                    switch(activeFilters.sortBy) {
                        case 'nama': sortText = 'Nama A-Z'; break;
                        case 'nama_desc': sortText = 'Nama Z-A'; break;
                        case 'harga': sortText = 'Harga Terendah'; break;
                        case 'harga_desc': sortText = 'Harga Tertinggi'; break;
                        case 'stok': sortText = 'Stok Terbanyak'; break;
                    }
                    addActiveFilter('sort', `Urutkan: ${sortText}`);
                }
            }

            function addActiveFilter(type, text) {
                const filterTag = document.createElement('div');
                filterTag.className = 'filter-tag';
                filterTag.innerHTML = `
                    <span>${text}</span>
                    <button class="remove-filter" data-type="${type}">
                        <i class="bi bi-x"></i>
                    </button>
                `;
                activeFiltersList.appendChild(filterTag);
            }

            // Filter products based on active filters
            function filterProducts() {
                let visibleCount = 0;

                produkCards.forEach(card => {
                    let visible = true;
                    const harga = parseInt(card.dataset.harga);
                    const stok = parseInt(card.dataset.stok);
                    const nama = card.dataset.nama.toLowerCase();
                    const deskripsi = card.dataset.deskripsi.toLowerCase();
                    const kategori = card.dataset.category;

                    // Category filter
                    if (activeFilters.category !== 'all' && kategori !== activeFilters.category) {
                        visible = false;
                    }

                    // Search filter
                    if (activeFilters.search) {
                        const searchTerm = activeFilters.search.toLowerCase();
                        if (!nama.includes(searchTerm) && !deskripsi.includes(searchTerm)) {
                            visible = false;
                        }
                    }

                    // Price filter
                    if (activeFilters.minPrice && harga < parseInt(activeFilters.minPrice)) {
                        visible = false;
                    }
                    if (activeFilters.maxPrice && harga > parseInt(activeFilters.maxPrice)) {
                        visible = false;
                    }

                    // Stock status filter
                    if (activeFilters.stockStatus.length > 0) {
                        let stockMatch = false;
                        if (activeFilters.stockStatus.includes('available') && stok >= 10) {
                            stockMatch = true;
                        }
                        if (activeFilters.stockStatus.includes('low') && stok > 0 && stok < 10) {
                            stockMatch = true;
                        }
                        if (activeFilters.stockStatus.includes('out') && stok === 0) {
                            stockMatch = true;
                        }
                        if (!stockMatch) {
                            visible = false;
                        }
                    }

                    // Apply visibility
                    card.style.display = visible ? 'flex' : 'none';
                    if (visible) visibleCount++;
                });

                // Show no products message if needed
                const noProducts = document.querySelector('.no-products');
                if (noProducts) {
                    noProducts.style.display = visibleCount === 0 ? 'block' : 'none';
                }

                // Sort products if sortBy is set
                if (activeFilters.sortBy) {
                    sortProducts();
                }
            }

            // Sort products
            function sortProducts() {
                const container = productsGrid;
                const cards = Array.from(container.querySelectorAll('.product-card'));

                cards.sort((a, b) => {
                    switch(activeFilters.sortBy) {
                        case 'nama':
                            return a.dataset.nama.localeCompare(b.dataset.nama);
                        case 'nama_desc':
                            return b.dataset.nama.localeCompare(a.dataset.nama);
                        case 'harga':
                            return parseInt(a.dataset.harga) - parseInt(b.dataset.harga);
                        case 'harga_desc':
                            return parseInt(b.dataset.harga) - parseInt(a.dataset.harga);
                        case 'stok':
                            return parseInt(b.dataset.stok) - parseInt(a.dataset.stok);
                        default:
                            return 0;
                    }
                });

                // Reorder cards
                cards.forEach(card => container.appendChild(card));
            }

            // Search functionality
            searchInput.addEventListener('input', function() {
                activeFilters.search = this.value.toLowerCase();
                updateFilterCount();
                updateActiveFiltersList();
                filterProducts();

                // Update URL without page reload
                const url = new URL(window.location);
                if (this.value) {
                    url.searchParams.set('search', this.value);
                } else {
                    url.searchParams.delete('search');
                }
                window.history.pushState({}, '', url);
            });

            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                activeFilters.search = '';
                updateFilterCount();
                updateActiveFiltersList();
                filterProducts();

                // Update URL
                const url = new URL(window.location);
                url.searchParams.delete('search');
                window.history.pushState({}, '', url);
            });

            // Category filter
            categoryPills.forEach(pill => {
                pill.addEventListener('click', function() {
                    const category = this.dataset.category;

                    // Update active class
                    categoryPills.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');

                    // Update filter
                    activeFilters.category = category;
                    updateFilterCount();
                    updateActiveFiltersList();
                    filterProducts();

                    // Update URL
                    const url = new URL(window.location);
                    if (category !== 'all') {
                        url.searchParams.set('category', category);
                    } else {
                        url.searchParams.delete('category');
                    }
                    window.history.pushState({}, '', url);
                });
            });

            // Sort dropdown
            sortBtn.addEventListener('click', function() {
                sortDropdown.classList.toggle('open');
            });

            sortOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const sortBy = this.dataset.sort;

                    // Update active class
                    sortOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');

                    // Update sort button text
                    const sortText = this.querySelector('span').textContent;
                    sortBtn.querySelector('span').textContent = sortText;

                    // Update filter
                    activeFilters.sortBy = sortBy;
                    sortDropdown.classList.remove('open');
                    updateFilterCount();
                    updateActiveFiltersList();
                    filterProducts();
                });
            });

            // View toggle
            viewButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const view = this.dataset.view;

                    // Update active class
                    viewButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    // Toggle grid/list view
                    if (view === 'list') {
                        productsGrid.classList.add('list-view');
                    } else {
                        productsGrid.classList.remove('list-view');
                    }
                });
            });

            // Filter sidebar
            openFilterBtn.addEventListener('click', function() {
                filterSidebar.classList.add('open');
                filterOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });

            closeFilterBtn.addEventListener('click', closeFilterSidebar);
            filterOverlay.addEventListener('click', closeFilterSidebar);

            function closeFilterSidebar() {
                filterSidebar.classList.remove('open');
                filterOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            // Stock status filter
            statusOptions.forEach(option => {
                option.addEventListener('click', function() {
                    this.classList.toggle('active');
                    const status = this.dataset.status;

                    if (this.classList.contains('active')) {
                        if (!activeFilters.stockStatus.includes(status)) {
                            activeFilters.stockStatus.push(status);
                        }
                    } else {
                        activeFilters.stockStatus = activeFilters.stockStatus.filter(s => s !== status);
                    }

                    updateFilterCount();
                });
            });

            // Remove active filter
            activeFiltersList.addEventListener('click', function(e) {
                if (e.target.closest('.remove-filter')) {
                    const type = e.target.closest('.remove-filter').dataset.type;

                    switch(type) {
                        case 'category':
                            activeFilters.category = 'all';
                            categoryPills.forEach(p => {
                                p.classList.remove('active');
                                if (p.dataset.category === 'all') {
                                    p.classList.add('active');
                                }
                            });
                            break;
                        case 'search':
                            activeFilters.search = '';
                            searchInput.value = '';
                            break;
                        case 'minPrice':
                            activeFilters.minPrice = null;
                            minPriceInput.value = '';
                            break;
                        case 'maxPrice':
                            activeFilters.maxPrice = null;
                            maxPriceInput.value = '';
                            break;
                        case 'sort':
                            activeFilters.sortBy = null;
                            sortOptions.forEach(opt => opt.classList.remove('active'));
                            sortBtn.querySelector('span').textContent = 'Urutkan';
                            break;
                        default:
                            if (type.startsWith('stock_')) {
                                const status = type.replace('stock_', '');
                                activeFilters.stockStatus = activeFilters.stockStatus.filter(s => s !== status);
                                statusOptions.forEach(opt => {
                                    if (opt.dataset.status === status) {
                                        opt.classList.remove('active');
                                    }
                                });
                            }
                    }

                    updateFilterCount();
                    updateActiveFiltersList();
                    filterProducts();
                }
            });

            // Clear all filters
            clearAllFiltersBtn.addEventListener('click', function() {
                activeFilters = {
                    category: 'all',
                    search: '',
                    minPrice: null,
                    maxPrice: null,
                    stockStatus: [],
                    sortBy: null
                };

                // Reset UI
                searchInput.value = '';
                categoryPills.forEach(p => {
                    p.classList.remove('active');
                    if (p.dataset.category === 'all') {
                        p.classList.add('active');
                    }
                });
                minPriceInput.value = '';
                maxPriceInput.value = '';
                statusOptions.forEach(opt => opt.classList.remove('active'));
                sortOptions.forEach(opt => opt.classList.remove('active'));
                sortBtn.querySelector('span').textContent = 'Urutkan';

                updateFilterCount();
                updateActiveFiltersList();
                filterProducts();

                // Clear URL parameters
                window.history.pushState({}, '', window.location.pathname);
            });

            // Reset filters in sidebar
            resetFiltersBtn.addEventListener('click', function() {
                minPriceInput.value = '';
                maxPriceInput.value = '';
                statusOptions.forEach(opt => opt.classList.remove('active'));
                activeFilters.stockStatus = [];
                updateFilterCount();
            });

            // Apply filters
            applyFiltersBtn.addEventListener('click', function() {
                activeFilters.minPrice = minPriceInput.value || null;
                activeFilters.maxPrice = maxPriceInput.value || null;

                updateFilterCount();
                updateActiveFiltersList();
                filterProducts();
                closeFilterSidebar();
            });

            // Add to cart functionality
            document.querySelectorAll('.cart-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const produkId = this.getAttribute('data-id');
                    const originalContent = this.innerHTML;

                    // Show loading
                    this.innerHTML = '<i class="bi bi-hourglass-split"></i>';
                    this.style.pointerEvents = 'none';

                    fetch("{{ route('keranjang.tambah') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            produk_id: produkId,
                            variasi: null
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        // Restore button
                        this.innerHTML = originalContent;
                        this.style.pointerEvents = '';

                        if (data.success) {
                            // Show success message
                            const toast = document.createElement('div');
                            toast.className = 'toast-success';
                            toast.innerHTML = `
                                <i class="bi bi-check-circle"></i>
                                <span>Produk berhasil ditambahkan ke keranjang!</span>
                            `;
                            document.body.appendChild(toast);

                            setTimeout(() => {
                                toast.classList.add('show');
                            }, 10);

                            setTimeout(() => {
                                toast.classList.remove('show');
                                setTimeout(() => {
                                    document.body.removeChild(toast);
                                }, 300);
                            }, 3000);

                            // Trigger cart update event
                            document.dispatchEvent(new CustomEvent('cartUpdated'));
                        } else {
                            alert(data.message || 'Gagal menambahkan produk');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.innerHTML = originalContent;
                        this.style.pointerEvents = '';
                        alert('Terjadi kesalahan saat menambahkan produk');
                    });
                });
            });

            // Product card click (redirect to detail page)
            produkCards.forEach(card => {
                card.addEventListener('click', function(e) {
                    // Don't redirect if clicking on action buttons
                    if (e.target.closest('.product-actions') ||
                        e.target.closest('.action-btn') ||
                        e.target.closest('.product-overlay')) {
                        return;
                    }

                    const slug = this.dataset.slug;
                    if (slug) {
                        window.location.href = `/produk/${slug}`;
                    }
                });
            });

            // Initialize
            initializeFromUrl();
            updateActiveFiltersList();

            // Toast styles
            const style = document.createElement('style');
            style.textContent = `
                .toast-success {
                    position: fixed;
                    bottom: 20px;
                    right: 20px;
                    background: #00bfa5;
                    color: white;
                    padding: 12px 16px;
                    border-radius: 4px;
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    transform: translateY(100px);
                    opacity: 0;
                    transition: all 0.3s ease;
                    z-index: 9999;
                }

                .toast-success.show {
                    transform: translateY(0);
                    opacity: 1;
                }

                .toast-success i {
                    font-size: 18px;
                }
            `;
            document.head.appendChild(style);
        });

        // Handle browser back/forward
        window.addEventListener('popstate', function() {
            // Reload page to reflect URL changes
            window.location.reload();
        });
    </script>

@endsection
