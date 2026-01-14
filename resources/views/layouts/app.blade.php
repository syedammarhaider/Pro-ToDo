<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Professional Todo App')</title>
    
    <!-- Bootstrap CSS - UI framework -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons - Icons ke liye -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS - Apna custom styling -->
    <style>
        /* CSS Variables - Theme colors */
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
            font-size: 1.6rem;
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
            background: #f81ce5 !important;
            color: #ffffff !important;
            font-size: 1.25rem !important;
            font-weight: 900 !important;
            padding: 0.4rem 0.9rem !important;
            border-radius: 14px;
            box-shadow: 0 0 15px rgba(248, 28, 229, 0.6);
            border: none;
            margin-left: 10px;
            display: inline-block !important;
            flex-shrink: 0 !important;
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

            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            transition: all 0.3s ease;
            min-height: 44px;
            font-size: 0.9rem;
        }
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }
        .btn {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-cyan));
            color: white !important;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 14px;
            font-weight: 600;
            font-size: 0.9rem;
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,123,255,0.25);
        }
        .btn::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }
        .btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 25px rgba(0,123,255,0.35);
        }
        .btn:hover::before {
            left: 100%;
        }
        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
            min-height: 36px;
            border-radius: 12px;
        }
        .btn-success {
            background: linear-gradient(135deg, var(--accent-green), #00cc7a);
            color: white !important;
        }
        .btn-danger {
            background: linear-gradient(135deg, var(--accent-red), #ff2e4d);
            color: white !important;
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
        .form-label {
            color: var(--text-primary) !important;
            font-weight: 500 !important;
            font-size: 0.9rem !important;
            margin-bottom: 0.5rem;
        }
        .invalid-feedback {
            color: var(--accent-red) !important;
            font-size: 0.8rem !important;
            margin-top: 0.25rem;
        }
        .form-text {
            color: var(--text-secondary) !important;
            font-size: 0.8rem !important;
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
    @yield('styles')
</head>
<body>
    <!-- Include Header - Header include karen -->
    @include('layouts.header')

    <!-- Main Content Area - Main content area -->
    <main class="py-4">
        <div class="container">
            <!-- Success Messages - Kaamyaabi messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Error Messages - Error messages -->
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Page Content - Page ka content -->
            @yield('content')
        </div>
    </main>

    <!-- Include Footer - Footer include karen -->
    @include('layouts.footer')

    <!-- Bootstrap JS - Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (Optional) - jQuery agar zaroori ho -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- Custom JavaScript - Apna custom JavaScript -->
    <script>
        // Auto-dismiss alerts - Alerts ko khud band karna
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);

        // Confirm before delete - Delete se pehle confirm karna
        function confirmDelete(action) {
            if (confirm('Are you sure you want to delete this todo?')) {
                document.getElementById('delete-form').action = action;
                document.getElementById('delete-form').submit();
            }
        }

        // Drag and drop functionality - Drag aur drop ka kaam
        $(function() {
            // Sortable todos list - Todos ko sort karne ki salahiyat
            $('.sortable-list').sortable({
                handle: '.drag-handle',
                update: function(event, ui) {
                    var positions = [];
                    $('.sortable-list .todo-item').each(function(index) {
                        positions.push({
                            id: $(this).data('id'),
                            position: index + 1
                        });
                    });
                    
                    // Update positions via AJAX - AJAX ke zariye positions update karen
                    $.ajax({
                        url: '{{ route("todos.update-positions") }}',
                        method: 'POST',
                        data: {
                            positions: positions,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log('Positions updated');
                        }
                    });
                }
            });
        });

        // Toggle todo completion - Todo completion toggle karna
        function toggleComplete(id, url) {
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                location.reload();
            });
        }

        // Bulk actions - Ek saath multiple actions
        function toggleAllCheckboxes(source) {
            var checkboxes = document.getElementsByName('todo_ids[]');
            for(var i=0; i<checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
    
    @yield('scripts')
</body>
</html>