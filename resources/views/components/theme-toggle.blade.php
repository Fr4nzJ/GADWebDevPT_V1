<!-- Night Mode / Light Mode Toggle Button Component -->
<div class="theme-toggle-wrapper">
    <button 
        id="theme-toggle-btn"
        class="theme-toggle-button"
        title="Toggle Night Mode (Ctrl+Shift+N)"
        aria-label="Toggle night mode"
        data-theme-toggle
    >
        <!-- Sun icon for light mode (shown when in night mode) -->
        <svg class="theme-icon theme-icon-sun" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="5"></circle>
            <line x1="12" y1="1" x2="12" y2="3"></line>
            <line x1="12" y1="21" x2="12" y2="23"></line>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
            <line x1="1" y1="12" x2="3" y2="12"></line>
            <line x1="21" y1="12" x2="23" y2="12"></line>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
        </svg>
        
        <!-- Moon icon for night mode (shown when in light mode) -->
        <svg class="theme-icon theme-icon-moon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
        </svg>
    </button>
</div>

<style>
.theme-toggle-wrapper {
    display: inline-block;
    position: relative;
}

.theme-toggle-button {
    background: var(--glass-bg) !important;
    border: 1px solid var(--glass-border) !important;
    color: var(--text-primary) !important;
    width: 44px !important;
    height: 44px !important;
    border-radius: var(--radius-pill) !important;
    cursor: pointer !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.3s ease !important;
    backdrop-filter: blur(10px) !important;
    padding: 0 !important;
}

.theme-toggle-button:hover {
    background: var(--glass-hover) !important;
    transform: scale(1.05) !important;
    box-shadow: var(--shadow-hover) !important;
}

.theme-toggle-button:active {
    transform: scale(0.95) !important;
}

.theme-icon {
    display: none;
    stroke: currentColor;
}

/* Show sun icon in night mode */
html.night-mode .theme-icon-sun {
    display: block;
}

/* Show moon icon in light mode */
html.light-mode .theme-icon-moon,
:root .theme-icon-moon {
    display: block;
}

html.night-mode .theme-icon-moon,
html.light-mode .theme-icon-sun {
    display: none;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('theme-toggle-btn');
    
    if (toggleBtn && window.themeManager) {
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.themeManager.toggle();
        });
    }
    
    // Keyboard shortcut: Ctrl+Shift+N
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.shiftKey && e.key === 'N') {
            e.preventDefault();
            if (window.themeManager) {
                window.themeManager.toggle();
            }
        }
    });
});
</script>
