@extends('layouts.app')

@section('title', 'All Todos - Professional Todo App')

@section('styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

:root {
    /* Dark Blue Theme */
    --bg-sidebar: #04123d;
    --bg-main: #0f1a4d;
    --card-dark: #091236;
    --text-primary: #ffffff;
    --text-secondary: #b2b9d1;
    --accent-pink: #eb00ff;
    --accent-blue: #007bff;
    --accent-cyan: #00d2ff;
    --accent-red: #ff4b5c;
    --accent-yellow: #ffc107;
    --accent-green: #00ff88;
    --accent-purple: #9d4edd;
    --accent-orange: #ff6b35;
    --glass-bg: rgba(9, 18, 54, 0.75);
    --glass-border: rgba(255, 255, 255, 0.1);
}

/* Reset & Base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    background: linear-gradient(135deg, var(--bg-main) 0%, #1a2a6c 50%, var(--card-dark) 100%);
    color: var(--text-primary);
    font-family: 'Inter', sans-serif;
    letter-spacing: -0.01em;
    min-height: 100vh;
    overflow-x: hidden;
    position: relative;
}

/* Background pattern */
body::before {
    content: '';
    position: fixed;
    top:0; left:0; width:100%; height:100%;
    background-image: 
        radial-gradient(circle at 20% 80%, rgba(0,210,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(235,0,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(0,255,136,0.05) 0%, transparent 50%);
    z-index: -1;
}

/* Glass effect container */
.glass-effect {
    background: var(--glass-bg);
    backdrop-filter: blur(25px) saturate(180%);
    -webkit-backdrop-filter: blur(25px) saturate(180%);
    border: 1.5px solid var(--glass-border);
    border-radius: 28px;
    box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5), inset 0 1px 0 0 rgba(255,255,255,0.1);
}

/* Ultra compact header */
.page-header {
    margin-bottom: 1.5rem;
    transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
}
.page-header.compact {
    margin-bottom: 1rem;
}
.page-header h1 {
    font-weight: 800;
    background: linear-gradient(135deg, #fff 0%, var(--accent-cyan) 50%, var(--accent-pink) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 2rem;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
    flex-wrap: wrap;
}
.page-header h1::after {
    content: '';
    width: 4px;
    height: 2.5rem;
    background: linear-gradient(to bottom, var(--accent-cyan), var(--accent-pink));
    border-radius: 2px;
    display: inline-block;
}
.page-header .badge {
    background: linear-gradient(135deg, var(--accent-pink), var(--accent-purple));
    font-size: 0.75rem;
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-weight: 700;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(235,0,255,0.3);
}

/* Header responsiveness */
/* --- High-End Header Styling --- */
.page-header.compact {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 1rem 1.25rem;
    border: 1px solid rgba(255, 255, 255, 0.08);
    margin-bottom: 2rem;
}

.page-header h1 {
    color: #ffffff;
    font-weight: 700;
    font-size: 1.75rem;
    margin-bottom: 0;
    display: flex;
    align-items: center;
    gap: 12px;
    letter-spacing: -0.5px;
}

.page-header h1 i {
    color: var(--neon-blue); /* Electric Blue from the image */
    text-shadow: 0 0 15px rgba(0, 112, 243, 0.4);
}

/* Fix for Badge Visibility & Style */
.page-header .badge {
    background: var(--neon-pink) !important; /* Neon Pink from image */
    color: #ffffff !important;
    font-size: 0.75rem;
    font-weight: 800;
    padding: 0.4rem 0.8rem !important;
    border-radius: 50px;
    box-shadow: 0 0 15px rgba(248, 28, 229, 0.4);
    border: none;
    vertical-align: middle;
}

/* Button Styling to match the FAB (+) */
.btn-primary-micro {
    background: linear-gradient(135deg, var(--neon-pink), #7000ff);
    color: white !important;
    border: none;
    padding: 0.6rem 1.2rem;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(248, 28, 229, 0.3);
}

.btn-primary-micro:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(248, 28, 229, 0.5);
}

/* --- THE MOBILE FIX (保持 Amazing Look) --- */
/* --- High-End Header Styling --- */
.page-header.compact {
    background: rgba(255, 255, 255, 0.04);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 0.8rem 1.25rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 2rem;
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
}

/* Force everything in one line and allow the badge to stay visible */
.page-header .d-flex {
    display: flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important; 
    align-items: center !important;
    justify-content: space-between !important;
    width: 100%;
}

.page-header h1 {
    color: #ffffff !important;
    font-weight: 700;
    font-size: 1.6rem; /* Slightly increased */
    margin-bottom: 0;
    display: flex;
    align-items: center;
    gap: 12px;
    white-space: nowrap;
}

.page-header h1 i {
    color: #0070f3;
    filter: drop-shadow(0 0 8px rgba(0, 112, 243, 0.6));
    flex-shrink: 0;
}

/* THE NUMBER (BADGE) - Fixed visibility & white font */
.page-header .badge {
    background: #f81ce5 !important; /* Neon Pink */
    color: #ffffff !important;      /* Forced White Font */
    font-size: 1.25rem !important;  /* Increased Size */
    font-weight: 900 !important;    /* Extra Bold */
    padding: 0.4rem 0.9rem !important;
    border-radius: 14px;
    box-shadow: 0 0 15px rgba(248, 28, 229, 0.6);
    border: none;
    margin-left: 10px;
    display: inline-block !important; /* Ensure it stays visible */
    flex-shrink: 0 !important;        /* Prevents squashing to 0 size */
    line-height: 1;
    visibility: visible !important;
    opacity: 1 !important;
    position: relative !important;
    z-index: 10 !important;
}

/* Button Styling */
.btn-primary-micro {
    background: linear-gradient(135deg, #f81ce5, #7000ff);
    color: white !important;
    padding: 0.7rem 1.1rem;
    border-radius: 14px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(248, 28, 229, 0.3);
    margin-left: 15px;
    flex-shrink: 0;
}

/* --- MOBILE SPECIFIC --- */
@media (max-width: 767px) {
    .page-header.compact {
        padding: 0.6rem 0.8rem !important;
    }

    .page-header h1 {
        font-size: 1.2rem !important;
        gap: 8px !important;
    }

    /* Keep the number big even on small screens */
    .page-header .badge {
        font-size: 0.9rem !important; 
        padding: 0.3rem 0.7rem !important;
        margin-left: 6px;
        background: #f81ce5 !important;
        color: #ffffff !important;
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .btn-primary-micro {
        padding: 0.6rem 0.8rem !important;
        border-radius: 12px;
    }

    .btn-primary-micro span {
        display: none !important; 
    }
}

@media (max-width: 480px) {
    .page-header h1 {
        font-size: 1.25rem !important;
    }
    .page-header h1 i {
        font-size: 1rem !important;
    }
    .page-header .badge {
        font-size: 0.8rem !important;
        padding: 0.3rem 0.6rem !important;
        background: #f81ce5 !important;
        color: #ffffff !important;
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
}

@media (min-width: 768px) and (max-width: 1024px) {
    .page-header h1 {
        font-size: 1.75rem;
    }
    .page-header .d-flex {
        gap: 1.5rem;
    }
}

@media (min-width: 1025px) {
    .page-header h1 {
        font-size: 2.25rem;
    }
    .page-header .d-flex {
        gap: 2rem;
    }
}

/* Micro primary button */
.btn-primary-micro {
    background: linear-gradient(135deg, var(--accent-blue) 0%, var(--accent-cyan) 100%);
    border: none;
    padding: 0.5rem 1.2rem;
    border-radius: 16px;
    font-weight: 600;
    font-size: 0.875rem;
    min-height: 40px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,123,255,0.25);
}
.btn-primary-micro::before {
    content: '';
    position: absolute;
    top: 0; left: -100%;
    width: 100%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: 0.5s;
}
.btn-primary-micro:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 12px 25px rgba(0,123,255,0.35);
}
.btn-primary-micro:hover::before {
    left: 100%;
}

/* Floating message container */
.message-container {
    position: fixed;
    top: 20px; right: 20px;
    z-index: 99999;
    display: flex;
    flex-direction: column;
    gap: 12px;
    max-width: 380px;
    width: 100%;
    pointer-events: none;
}
.message {
    background: var(--glass-bg);
    backdrop-filter: blur(20px);
    border: 1.5px solid var(--glass-border);
    border-radius: 20px;
    padding: 1.25rem 1.5rem;
    box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    transform: translateX(120%);
    transition: transform 0.5s cubic-bezier(0.68,-0.55,0.265,1.55);
    pointer-events: all;
    position: relative;
    overflow: hidden;
    border-left: 5px solid;
    animation: messageFloat 3s ease-in-out infinite;
}
.message.show {
    transform: translateX(0);
}
.message.success { border-left-color: var(--accent-green); background: linear-gradient(135deg, rgba(0,255,136,0.1), rgba(9,18,54,0.8)); }
.message.error { border-left-color: var(--accent-red); background: linear-gradient(135deg, rgba(255,75,92,0.1), rgba(9,18,54,0.8)); }
.message.info { border-left-color: var(--accent-cyan); background: linear-gradient(135deg, rgba(0,210,255,0.1), rgba(9,18,54,0.8)); }
.message.warning { border-left-color: var(--accent-yellow); background: linear-gradient(135deg, rgba(255,193,7,0.1), rgba(9,18,54,0.8)); }
.message::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
}
.message-content {
    display: flex;
    align-items: center;
    gap: 1rem;
}
.message-icon {
    font-size: 1.5rem;
    min-width: 40px; height: 40px;
    background: rgba(255,255,255,0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.message.success .message-icon { color: var(--accent-green); }
.message.error .message-icon { color: var(--accent-red); }
.message.info .message-icon { color: var(--accent-cyan); }
.message.warning .message-icon { color: var(--accent-yellow); }
.message-text h5 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: white;
}
.message-text p {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0;
    line-height: 1.4;
}
.message-close {
    position: absolute;
    top: 12px; right: 12px;
    background: rgba(255,255,255,0.1);
    border: none;
    color: var(--text-secondary);
    width: 24px; height: 24px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    font-size: 0.75rem;
    transition: all 0.2s;
}
.message-close:hover {
    background: rgba(255,255,255,0.2);
    color: white;
}
@keyframes messageFloat {
    0%, 100% { transform: translateX(0) translateY(0); }
    50% { transform: translateX(0) translateY(-5px); }
}

/* Filters - ultra compact */
.filters-card { margin-bottom: 1.5rem; transition: all 0.3s; }
.filters-collapsed { padding: 0.75rem !important; }
.filter-toggle-btn {
    background: rgba(255,255,255,0.05);
    border: 1.5px solid var(--glass-border);
    border-radius: 16px;
    color: var(--text-secondary);
    padding: 0.5rem 1rem;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
    cursor: pointer;
}
.filter-toggle-btn:hover {
    background: rgba(255,255,255,0.1);
    color: white;
    transform: translateY(-1px);
}
.form-control-micro, .form-select-micro {
    background: rgba(255,255,255,0.07);
    border: 1.5px solid rgba(255,255,255,0.12);
    color: white;
    border-radius: 14px;
    padding: 0.6rem 1rem;
    font-size: 0.875rem;
    height: 42px;
}
.form-control-micro:focus, .form-select-micro:focus {
    background: rgba(255,255,255,0.12);
    border-color: var(--accent-cyan);
    box-shadow: 0 0 0 0.25rem rgba(0,210,255,0.2);
    color: white;
}

/* Ultra compact todo items */
.todo-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 16px;
    animation: slideUp 0.5s ease-out;
}
.todo-item-micro {
    background: linear-gradient(145deg, rgba(13,23,66,0.9), rgba(9,18,54,0.9));
    border-radius: 20px;
    padding: 1rem !important;
    transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
    border-left: 4px solid;
    position: relative;
    overflow: hidden;
    cursor: pointer;
    min-height: 120px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.todo-item-micro:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.05);
}
.todo-item-micro.low { border-left-color: var(--accent-green); }
.todo-item-micro.medium { border-left-color: var(--accent-yellow); }
.todo-item-micro.high { border-left-color: var(--accent-red); }
.todo-item-micro.completed {
    opacity: 0.8;
    background: linear-gradient(145deg, rgba(10,15,40,0.9), rgba(5,10,30,0.9));
}
.todo-item-micro.completed .todo-title-micro {
    text-decoration: line-through;
    opacity: 0.6;
    color: rgba(255,255,255,0.7);
}
.todo-item-micro.completed .priority-badge-micro,
.todo-item-micro.completed .category-tag-micro,
.todo-item-micro.completed .due-date-micro {
    opacity: 0.7;
}

/* Compact todo header */
.todo-header-micro {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 0.75rem;
    gap: 0.75rem;
}
.todo-checkbox-micro {
    width: 18px !important;
    height: 18px !important;
    margin-top: 2px;
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 6px;
    cursor: pointer;
}
.todo-checkbox-micro:checked {
    background-color: var(--accent-pink);
    border-color: var(--accent-pink);
}
.todo-title-micro {
    font-size: 0.95rem;
    font-weight: 600;
    line-height: 1.3;
    color: white;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.todo-actions-micro {
    display: flex;
    gap: 0.4rem;
}
.todo-actions-micro .btn-micro {
    width: 28px;
    height: 28px;
    min-width: 28px;
    padding: 0;
    border-radius: 50% !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    transition: all 0.2s;
}
.todo-actions-micro .btn-micro:hover {
    transform: scale(1.15);
    border-color: rgba(255,255,255,0.3);
}

/* Compact todo footer */
.todo-footer-micro {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
    padding-top: 0.75rem;
    border-top: 1px solid rgba(255,255,255,0.05);
}
.todo-meta-micro {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
}
.priority-badge-micro {
    font-size: 0.65rem;
    padding: 0.2rem 0.6rem;
    border-radius: 12px;
    font-weight: 700;
    text-transform: uppercase;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
}
.category-tag-micro {
    font-size: 0.65rem;
    padding: 0.2rem 0.6rem;
    background: rgba(0,210,255,0.15);
    border-radius: 12px;
    color: var(--accent-cyan);
    border: 1px solid rgba(0,210,255,0.3);
}
.due-date-micro {
    font-size: 0.7rem;
    font-weight: 500;
    color: white;
}
.due-date-micro.overdue {
    color: var(--accent-red) !important;
    animation: pulse 2s infinite;
}

/* Quick actions floating bar */
.quick-actions-bar {
    position: fixed;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000;
    background: linear-gradient(135deg, #007bff, #00d2ff);
    backdrop-filter: blur(20px);
    border: 1.5px solid var(--glass-border);
    border-radius: 24px 24px 0 0;
    padding: 0.75rem 1.25rem;
    display: flex;
    gap: 0.75rem;
    box-shadow: 0 -5px 20px rgba(0,123,255,0.4);
    animation: slideUp 0.4s ease-out;
}
.quick-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    font-size: 0.9rem;
    transition: all 0.3s;
    position: relative;
    overflow: hidden;
}
.quick-btn::after {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%) translateY(-10px);
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    font-size: 0.75rem;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s;
    margin-bottom: 5px;
}
.quick-btn:hover::after {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
}
.quick-btn-primary { background: linear-gradient(135deg, var(--accent-blue), var(--accent-cyan)); }
.quick-btn-success { background: linear-gradient(135deg, var(--accent-green), #00cc7a); }
.quick-btn-danger { background: linear-gradient(135deg, var(--accent-red), #ff2e4d); }
.quick-btn:hover {
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 10px 20px rgba(0,0,0,0.3);
}

/* Empty state compact */
.empty-state-micro {
    padding: 3rem 1.5rem;
    text-align: center;
}
.empty-icon-micro {
    font-size: 3.5rem;
    background: linear-gradient(135deg, var(--accent-cyan) 0%, var(--accent-pink) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
    display: inline-block;
    animation: float 3s ease-in-out infinite;
}
.empty-state-micro h5 {
    font-size: 1.1rem;
    color: white;
    margin-bottom: 0.5rem;
}
.empty-state-micro p {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* Responsive */
@media (max-width: 991px) {
    .page-header h1 {
        font-size: 1.6rem;
    }
    .todo-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 14px;
    }
    .message-container {
        right: 15px;
        max-width: 320px;
    }
    .quick-actions-bar {
        padding: 0.6rem 1rem;
        gap: 0.6rem;
    }
    .quick-btn {
        width: 34px;
        height: 34px;
        font-size: 0.85rem;
    }
}
@media (max-width: 767px) {
    body {
        padding-bottom: 70px;
    }
    .page-header {
        margin-bottom: 1rem;
    }
    .page-header h1 {
        font-size: 1.3rem;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    .page-header h1::after {
        display: none;
    }
    .btn-primary-micro {
        padding: 0.4rem 1rem;
        font-size: 0.8rem;
        min-height: 36px;
    }
    .message-container {
        top: 10px;
        right: 10px;
        max-width: calc(100% - 20px);
    }
    .message {
        padding: 1rem;
        border-radius: 16px;
    }
    .message-content {
        gap: 0.75rem;
    }
    .message-icon {
        min-width: 32px;
        height: 32px;
        font-size: 1.2rem;
    }
    .todo-grid {
        grid-template-columns: 1fr;
        gap: 12px;
        padding: 0.5rem;
    }
    .todo-item-micro {
        padding: 0.875rem !important;
        min-height: 110px;
        border-radius: 18px;
    }
    .todo-title-micro {
        font-size: 0.9rem;
        -webkit-line-clamp: 1;
    }
    .todo-actions-micro .btn-micro {
        width: 26px;
        height: 26px;
        min-width: 26px;
        font-size: 0.7rem;
    }
    .todo-footer-micro {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    .quick-actions-bar {
        bottom: 0;
        left: 0;
        right: 0;
        transform: none;
        justify-content: space-around;
        padding: 0.6rem;
        border-radius: 20px 20px 0 0;
        background: linear-gradient(135deg, #007bff, #00d2ff);
        box-shadow: 0 -5px 20px rgba(0,123,255,0.4);
    }
    .quick-btn {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
    }
    .quick-btn::after {
        display: none;
    }
    /* Fix Select All visibility */
    .form-check-label {
        color: var(--text-primary) !important;
        font-weight: 500 !important;
        font-size: 0.9rem !important;
    }
    .filter-toggle-btn {
        color: var(--text-primary) !important;
        font-weight: 500 !important;
    }
}
@media (max-width: 480px) {
    .page-header .d-flex {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }
    .page-header h1 {
        font-size: 1.1rem;
    }
    .page-header .badge {
        font-size: 0.8rem !important;
        padding: 0.3rem 0.6rem !important;
        background: #f81ce5 !important;
        color: #ffffff !important;
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    .filters-card {
        margin-bottom: 1rem;
    }
    .filter-toggle-btn {
        width: 100%;
        justify-content: center;
        padding: 0.6rem;
        font-size: 0.8rem;
    }
    .todo-grid {
        gap: 10px;
        padding: 0.25rem;
    }
    .todo-item-micro {
        padding: 0.75rem !important;
        min-height: 100px;
        border-radius: 16px;
    }
    .todo-header-micro {
        gap: 0.5rem;
    }
    .todo-title-micro {
        font-size: 0.85rem;
    }
    .todo-actions-micro {
        gap: 0.25rem;
    }
    .todo-actions-micro .btn-micro {
        width: 24px;
        height: 24px;
        min-width: 24px;
        font-size: 0.65rem;
    }
    .todo-meta-micro {
        gap: 0.5rem;
    }
    .priority-badge-micro,
    .category-tag-micro {
        font-size: 0.6rem;
        padding: 0.15rem 0.5rem;
    }
    .due-date-micro {
        font-size: 0.65rem;
    }
    .empty-state-micro {
        padding: 2rem 1rem;
    }
    .empty-icon-micro {
        font-size: 2.5rem;
    }
    .empty-state-micro h5 {
        font-size: 1rem;
    }
    .empty-state-micro p {
        font-size: 0.8rem;
    }
}
@media (max-width: 360px) {
    .page-header h1 {
        font-size: 1rem;
        gap: 0.4rem;
    }
    .btn-primary-micro {
        padding: 0.35rem 0.875rem;
        font-size: 0.75rem;
        min-height: 32px;
    }
    .todo-item-micro {
        padding: 0.625rem !important;
        min-height: 90px;
    }
    .todo-title-micro {
        font-size: 0.8rem;
    }
    .todo-checkbox-micro {
        width: 16px !important;
        height: 16px !important;
    }
    .todo-actions-micro .btn-micro {
        width: 22px;
        height: 22px;
        min-width: 22px;
        font-size: 0.6rem;
    }
    .quick-actions-bar {
        left: 5px;
        right: 5px;
        padding: 0.5rem;
        border-radius: 18px;
    }
    .quick-btn {
        width: 30px;
        height: 30px;
        font-size: 0.75rem;
    }
}

/* Animations */
@keyframes slideUp {
    from {opacity: 0; transform: translateY(30px);}
    to {opacity: 1; transform: translateY(0);}
}
@keyframes pulse {
    0%, 100% {opacity: 1;}
    50% {opacity: 0.7;}
}
@keyframes ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}
.todo-grid {
    animation: slideUp 0.5s ease-out;
}

/* Utility */
.visually-hidden {
    position: absolute;
    width: 1px; height: 1px;
    padding: 0; margin: -1px;
    overflow: hidden;
    clip: rect(0,0,0,0);
    white-space: nowrap;
    border: 0;
}
.text-truncate-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.fade-in {
    animation: fadeIn 0.3s ease-out;
}
@keyframes fadeIn {
    from {opacity: 0;}
    to {opacity: 1;}
}
</style>
@endsection

@section('content')
<!-- Floating Messages -->
<div class="message-container" id="messageContainer" aria-live="assertive" aria-atomic="true" aria-relevant="additions"></div>

<!-- Quick Actions -->
<div class="quick-actions-bar" id="quickActionsBar" role="toolbar" aria-label="Quick actions">
    <button class="quick-btn quick-btn-primary" data-tooltip="New Todo" aria-label="New Todo" onclick="window.location.href='{{ route('todos.create') }}'">
        <i class="fas fa-plus"></i>
    </button>
    <button class="quick-btn quick-btn-success" data-tooltip="Bulk Complete" aria-label="Bulk Complete selected todos" onclick="bulkComplete()">
        <i class="fas fa-check-double"></i>
    </button>
    <button class="quick-btn quick-btn-danger" data-tooltip="Bulk Delete" aria-label="Bulk Delete selected todos" onclick="bulkDelete()">
        <i class="fas fa-trash-can"></i>
    </button>
    <button class="quick-btn" data-tooltip="Toggle Filters" aria-label="Toggle Filters" onclick="toggleFilters()" style="background: linear-gradient(135deg, var(--accent-purple), var(--accent-pink))">
        <i class="fas fa-filter" id="filterIcon"></i>
    </button>
</div>

<div class="container-fluid px-2 px-md-3">
    <!-- Header -->
    <header class="page-header compact" id="pageHeader" role="banner">
        <div class="d-flex justify-content-between align-items-center" >
            <div class="d-flex align-items-center gap-3">
                <h1 tabindex="0">
            
                   
                    <span class="" aria-label="{{ $todos->total() }} todos total"> Total Todos {{ $todos->total() }} </span>
                </h1>
            </div>
            <a href="{{ route('todos.create') }}" class="btn-primary-micro" role="button" aria-label="Create new todo">
                <i class="fas fa-plus-circle" aria-hidden="true"></i>
                <span class="d-none d-sm-inline">New Todo</span>
            </a>
        </div>
    </header>

    <!-- Filters -->
    <section>
        <div class="card glass-effect filters-card" id="filtersCard">
            <div class="card-body p-3">
                <button class="filter-toggle-btn mb-3 w-100" aria-expanded="false" aria-controls="filterContent" onclick="toggleFilters()">
                    <i class="fas fa-sliders-h"></i>
                    <span>Filters & Search</span>
                    <i class="fas fa-chevron-down ms-auto" id="filterArrow"></i>
                </button>
                <div id="filterContent" style="display:none;">
                    <form action="{{ route('todos.index') }}" method="GET" class="row g-2" role="search" aria-label="Todo search and filters">
                        <div class="col-12 col-md-6 col-lg-3">
                            <input type="search" name="search" class="form-control-micro" placeholder="🔍 Search todos..." value="{{ request('search') }}" aria-label="Search todos">
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <select name="status" class="form-select-micro" aria-label="Filter by status">
                                <option value="">📊 Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>▶ Active</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                                <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>⏰ Overdue</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <select name="priority" class="form-select-micro" aria-label="Filter by priority">
                                <option value="">🎯 Priority</option>
                                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>🟢 Low</option>
                                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>🔴 High</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <select name="category" class="form-select-micro" aria-label="Filter by category">
                                <option value="">🏷️ Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-sm w-100" style="min-height:42px;" aria-label="Apply filters">
                                    <i class="fas fa-filter"></i>
                                    <span class="d-none d-md-inline">Filter</span>
                                </button>
                                <a href="{{ route('todos.index') }}" class="btn btn-secondary btn-sm w-100" style="min-height:42px;" aria-label="Reset filters">
                                    <i class="fas fa-rotate-right"></i>
                                    <span class="d-none d-md-inline">Reset</span>
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Bulk Actions -->
                    <div class="mt-3 d-flex justify-content-between align-items-center flex-wrap gap-2" aria-label="Bulk actions">
                        <div class="form-check">
                            <input class="form-check-input todo-checkbox-micro" type="checkbox" id="selectAll" onchange="toggleAllCheckboxes(this)" aria-label="Select or deselect all todos">
                            <label class="form-check-label" for="selectAll" style="font-size:0.875rem; color: var(--text-primary); font-weight: 500;">
                                Select All
                            </label>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-success btn-sm px-3" onclick="bulkComplete()" aria-label="Mark selected todos complete">
                                <i class="fas fa-check-double"></i>
                                <span class="d-none d-md-inline">Complete</span>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm px-3" onclick="bulkDelete()" aria-label="Delete selected todos">
                                <i class="fas fa-trash-can"></i>
                                <span class="d-none d-md-inline">Delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Todos Grid -->
    <section aria-live="polite" aria-relevant="additions removals" aria-label="List of todos">
        <div class="card glass-effect">
            <div class="card-body p-2 p-md-3">
                @if($todos->count() > 0)
                    <div class="todo-grid" id="todoGrid" role="list">
                        @foreach($todos as $todo)
                            <article class="todo-item-micro {{ $todo->priority }} {{ $todo->completed ? 'completed' : '' }}" 
                                     data-id="{{ $todo->id }}" role="listitem" tabindex="0" aria-label="Todo: {{ $todo->title }}, Priority: {{ ucfirst($todo->priority) }}, Status: {{ $todo->completed ? 'Completed' : 'Active' }}" onclick="toggleTodoSelect(this, event)">
                                <div class="todo-header-micro">
                                    <input class="form-check-input todo-checkbox-micro" 
                                           type="checkbox" 
                                           name="todo_ids[]" 
                                           value="{{ $todo->id }}" 
                                           aria-label="Select todo {{ $todo->title }}" 
                                           onclick="event.stopPropagation()">
                                    <h6 class="todo-title-micro text-truncate-2 {{ $todo->completed ? 'strikethrough' : '' }}" style="{{ $todo->completed ? 'opacity: 0.6; color: rgba(255,255,255,0.7);' : '' }}">{{ $todo->title }}</h6>
                                    <div class="todo-actions-micro">
                                        @if(!$todo->completed)
                                            <form action="{{ route('todos.complete', $todo) }}" method="POST" onclick="event.stopPropagation()">
                                                @csrf
                                                <button type="submit" class="btn-micro btn-success" title="Mark Complete" aria-pressed="false">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('todos.incomplete', $todo) }}" method="POST" onclick="event.stopPropagation()">
                                                @csrf
                                                <button type="submit" class="btn-micro btn-warning" title="Mark Incomplete" aria-pressed="true">
                                                    <i class="fas fa-rotate-left"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('todos.edit', $todo) }}" class="btn-micro btn-primary" title="Edit" onclick="event.stopPropagation()">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" onclick="event.stopPropagation()" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-micro btn-danger" onclick="return confirm('Delete this todo?')" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @if($todo->tags && count($todo->tags) > 0)
                                    <div class="mb-2" aria-label="Tags">
                                        @foreach(array_slice($todo->tags, 0, 2) as $tag)
                                            <span class="tag" style="font-size:0.65rem;"><i class="fas fa-hashtag"></i>{{ trim($tag) }}</span>
                                        @endforeach
                                        @if(count($todo->tags) > 2)
                                            <span class="tag" style="font-size:0.65rem;">+{{ count($todo->tags) - 2 }}</span>
                                        @endif
                                    </div>
                                @endif
                                <div class="todo-footer-micro">
                                    <div class="todo-meta-micro">
                                        <span class="priority-badge-micro bg-{{ $todo->getPriorityColor() }}">
                                            <i class="fas fa-flag"></i> {{ ucfirst($todo->priority) }}
                                        </span>
                                        @if($todo->category)
                                            <span class="category-tag-micro">
                                                <i class="fas fa-tag"></i> {{ $todo->category }}
                                            </span>
                                        @endif
                                        @if($todo->due_date)
                                            <span class="due-date-micro" style="color: white !important;">
                                                <i class="fas fa-calendar-day"></i> {{ $todo->due_date->format('M d') }}
                                                @if($todo->isOverdue())
                                                    <span style="color: var(--accent-red); font-weight: bold;">!</span>
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                    <a href="{{ route('todos.show', $todo) }}" class="text-decoration-none" onclick="event.stopPropagation()">
                                        <small style="color: white !important;"><i class="fas fa-eye"></i> View</small>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state-micro fade-in" role="alert" aria-live="polite" aria-atomic="true">
                        <div class="empty-icon-micro" aria-hidden="true"><i class="fas fa-clipboard-list"></i></div>
                        <h5>No todos found</h5>
                        <p>Start organizing your tasks and boost productivity!</p>
                        <a href="{{ route('todos.create') }}" class="btn-primary-micro" role="button" aria-label="Create your first todo">
                            <i class="fas fa-plus-circle"></i> Create First Todo
                        </a>
                    </div>
                @endif
            </div>
            
            @if($todos->hasPages())
                <div class="card-footer bg-transparent border-top border-white border-opacity-10 py-2">
                    <nav aria-label="Pagination navigation">
                        <div class="d-flex justify-content-center">
                            {{ $todos->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    </nav>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    let filtersVisible = false;

    function toggleFilters() {
        const filterContent = document.getElementById('filterContent');
        const filterArrow = document.getElementById('filterArrow');
        const filtersCard = document.getElementById('filtersCard');
        const filterIcon = document.getElementById('filterIcon');
        filtersVisible = !filtersVisible;
        if (filtersVisible) {
            filterContent.style.display = 'block';
            filterArrow.className = 'fas fa-chevron-up ms-auto';
            filtersCard.classList.remove('filters-collapsed');
            filterIcon.className = 'fas fa-times';
            showMessage('Filters expanded', 'info');
        } else {
            filterContent.style.display = 'none';
            filterArrow.className = 'fas fa-chevron-down ms-auto';
            filtersCard.classList.add('filters-collapsed');
            filterIcon.className = 'fas fa-filter';
            showMessage('Filters collapsed', 'info');
        }
    }

    function showMessage(text, type = 'info', duration = 4000) {
        const messageContainer = document.getElementById('messageContainer');
        const messageId = 'msg-' + Date.now();
        const icons = {
            success: 'fas fa-check-circle',
            error: 'fas fa-exclamation-circle',
            warning: 'fas fa-exclamation-triangle',
            info: 'fas fa-info-circle'
        };
        const message = document.createElement('div');
        message.className = `message ${type}`;
        message.id = messageId;
        message.innerHTML = `
            <div class="message-content">
                <div class="message-icon"><i class="${icons[type]}"></i></div>
                <div class="message-text">
                    <h5>${type.charAt(0).toUpperCase() + type.slice(1)}</h5>
                    <p>${text}</p>
                </div>
            </div>
            <button class="message-close" onclick="removeMessage('${messageId}')">
                <i class="fas fa-times"></i>
            </button>`;
        messageContainer.appendChild(message);
        setTimeout(() => { message.classList.add('show'); }, 10);
        if (duration > 0) {
            setTimeout(() => removeMessage(messageId), duration);
        }
    }

    function removeMessage(messageId) {
        const message = document.getElementById(messageId);
        if (message) {
            message.classList.remove('show');
            setTimeout(() => {
                if (message.parentNode) {
                    message.parentNode.removeChild(message);
                }
            }, 300);
        }
    }

    function toggleTodoSelect(todoElement, event) {
        if (['INPUT','BUTTON','A'].includes(event.target.tagName) || event.target.closest('a') || event.target.closest('button') || event.target.closest('form')) {
            return;
        }
        const checkbox = todoElement.querySelector('.todo-checkbox-micro');
        checkbox.checked = !checkbox.checked;
        const count = document.querySelectorAll('.todo-checkbox-micro:checked').length;
        if (count > 0) showMessage(`${count} todo${count>1?'s':''} selected`, 'info', 2000);
        todoElement.style.transform = 'scale(0.98)';
        setTimeout(() => { todoElement.style.transform = ''; }, 150);
    }

    function toggleAllCheckboxes(source) {
        const checkboxes = document.querySelectorAll('.todo-checkbox-micro');
        checkboxes.forEach(cb => cb.checked = source.checked);
        showMessage(`${source.checked ? 'All' : 'No'} todos selected`, 'info', 2000);
    }

    async function bulkComplete() {
        const checked = document.querySelectorAll('.todo-checkbox-micro:checked');
        if (!checked.length) { showMessage('Please select at least one todo', 'warning'); return; }
        const ids = Array.from(checked).map(cb => cb.value);
        if (!confirm(`Mark ${ids.length} todo${ids.length>1?'s':''} as completed?`)) return;
        showMessage(`Completing ${ids.length} todo${ids.length>1?'s':''}...`, 'info');
        try {
            const res = await fetch('{{ route("todos.bulk-complete") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ ids })
            });
            if (res.ok) {
                showMessage(`${ids.length} todo${ids.length>1?'s':''} marked as completed!`, 'success');
                setTimeout(() => location.reload(), 1500);
            } else showMessage('Failed to complete todos', 'error');
        } catch {
            showMessage('Network error. Please try again.', 'error');
        }
    }

    async function bulkDelete() {
        const checked = document.querySelectorAll('.todo-checkbox-micro:checked');
        if (!checked.length) { showMessage('Please select at least one todo', 'warning'); return; }
        const ids = Array.from(checked).map(cb => cb.value);
        if (!confirm(`Delete ${ids.length} todo${ids.length>1?'s':''} permanently? This cannot be undone.`)) return;
        showMessage(`Deleting ${ids.length} todo${ids.length>1?'s':''}...`, 'warning');
        try {
            const res = await fetch('{{ route("todos.bulk-delete") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ ids })
            });
            if (res.ok) {
                showMessage(`${ids.length} todo${ids.length>1?'s':''} deleted successfully!`, 'success');
                setTimeout(() => location.reload(), 1500);
            } else showMessage('Failed to delete todos', 'error');
        } catch {
            showMessage('Network error. Please try again.', 'error');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.btn, .todo-item-micro').forEach(el => {
            el.addEventListener('click', e => {
                if (el.classList.contains('todo-item-micro') && ['INPUT','A','BUTTON'].includes(e.target.tagName)) return;
                const ripple = document.createElement('span');
                const rect = el.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.4);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    pointer-events: none;`;
                el.style.position = 'relative';
                el.style.overflow = 'hidden';
                el.appendChild(ripple);
                setTimeout(() => ripple.remove(), 600);
            });
        });
        // Welcome message once per session
        if (!sessionStorage.getItem('welcomeShown')) {
            setTimeout(() => showMessage('Welcome to your todo manager! Tap todos to select multiple.', 'info', 5000), 1000);
            sessionStorage.setItem('welcomeShown', 'true');
        }
        // Show url message
        const params = new URLSearchParams(window.location.search);
        if (params.has('message')) {
            const msg = decodeURIComponent(params.get('message'));
            const type = params.get('type') || 'success';
            showMessage(msg, type, 5000);
        }
    });
</script>
@endsection