/**
 * Night Mode Theme Manager
 * Handles theme persistence, system preference detection, and dynamic theme switching
 */

class ThemeManager {
  constructor() {
    this.THEME_KEY = 'app-theme';
    this.LIGHT_MODE = 'light-mode';
    this.NIGHT_MODE = 'night-mode';
    this.init();
  }

  /**
   * Initialize theme on page load
   * Priority: localStorage > system preference > light-mode
   */
  init() {
    const savedTheme = localStorage.getItem(this.THEME_KEY);
    
    if (savedTheme) {
      // User has a saved preference
      this.applyTheme(savedTheme);
    } else {
      // No saved preference, check system preference
      if (this.getSystemPreference()) {
        this.applyTheme(this.NIGHT_MODE);
      } else {
        this.applyTheme(this.LIGHT_MODE);
      }
    }
  }

  /**
   * Check system preference for dark mode
   * @returns {boolean} True if system prefers dark mode
   */
  getSystemPreference() {
    return window.matchMedia('(prefers-color-scheme: dark)').matches;
  }

  /**
   * Apply theme to HTML element
   * @param {string} theme - Theme to apply (light-mode or night-mode)
   */
  applyTheme(theme) {
    const html = document.documentElement;
    
    // Remove existing theme classes
    html.classList.remove(this.LIGHT_MODE, this.NIGHT_MODE);
    
    // Apply new theme
    html.classList.add(theme);
    
    // Save preference
    localStorage.setItem(this.THEME_KEY, theme);
    
    // Dispatch event for other components to listen to
    window.dispatchEvent(new CustomEvent('theme-changed', {
      detail: { theme }
    }));
  }

  /**
   * Toggle between light and night mode
   */
  toggle() {
    const currentTheme = localStorage.getItem(this.THEME_KEY) || this.LIGHT_MODE;
    const newTheme = currentTheme === this.LIGHT_MODE ? this.NIGHT_MODE : this.LIGHT_MODE;
    this.applyTheme(newTheme);
  }

  /**
   * Get current theme
   * @returns {string} Current theme (light-mode or night-mode)
   */
  getCurrentTheme() {
    return localStorage.getItem(this.THEME_KEY) || this.LIGHT_MODE;
  }

  /**
   * Set theme to light mode
   */
  setLightMode() {
    this.applyTheme(this.LIGHT_MODE);
  }

  /**
   * Set theme to night mode
   */
  setNightMode() {
    this.applyTheme(this.NIGHT_MODE);
  }

  /**
   * Reset to system preference
   */
  resetToSystemPreference() {
    localStorage.removeItem(this.THEME_KEY);
    if (this.getSystemPreference()) {
      this.applyTheme(this.NIGHT_MODE);
    } else {
      this.applyTheme(this.LIGHT_MODE);
    }
  }
}

// Initialize on DOM ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => {
    window.themeManager = new ThemeManager();
  });
} else {
  window.themeManager = new ThemeManager();
}

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
  module.exports = ThemeManager;
}
