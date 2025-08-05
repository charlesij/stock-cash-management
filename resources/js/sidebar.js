// Debug mode
const DEBUG = true;

// Debug logger
const log = (message, data = null) => {
  if (DEBUG) {
    if (data) {
      console.log(`[Sidebar Debug] ${message}:`, data);
    } else {
      console.log(`[Sidebar Debug] ${message}`);
    }
  }
};

// Sidebar Controller
class SidebarController {
  constructor() {
    this.sidebar = $("#sidebar");
    this.overlay = $("#sidebar-overlay");
    this.toggleButton = $("#sidebar-toggle");
    this.closeButton = $("#sidebar-close");

    if (!this.sidebar.length) {
      log("Error: Sidebar element not found!");
      return;
    }

    log("Initializing sidebar controller");
    this.initializeEventListeners();
    this.initializeTouchEvents();
    this.setInitialState();
  }

  initializeEventListeners() {
    log("Setting up event listeners");

    // Toggle button
    if (this.toggleButton.length) {
      this.toggleButton.on("click", () => {
        log("Toggle button clicked");
        this.toggleSidebar();
      });
    } else {
      log("Warning: Toggle button not found");
    }

    // Close button
    if (this.closeButton.length) {
      this.closeButton.on("click", () => {
        log("Close button clicked");
        this.closeSidebar();
      });
    } else {
      log("Warning: Close button not found");
    }

    // Overlay
    if (this.overlay.length) {
      this.overlay.on("click", () => {
        log("Overlay clicked");
        this.closeSidebar();
      });
    } else {
      log("Warning: Overlay not found");
    }

    // Escape key
    $(document).on("keydown", (e) => {
      if (e.key === "Escape") {
        log("Escape key pressed");
        this.closeSidebar();
      }
    });

    // Window resize
    $(window).on("resize", () => {
      this.handleResize();
    });
  }

  setInitialState() {
    const width = $(window).width();
    log("Setting initial state", { windowWidth: width });

    if (width < 1024) {
      this.closeSidebar();
      log("Initial state: mobile - sidebar closed");
    } else {
      log("Initial state: desktop - sidebar visible");
    }
  }

  toggleSidebar() {
    log("Toggling sidebar");
    const isClosed = this.sidebar.hasClass("-translate-x-full");

    if (isClosed) {
      this.openSidebar();
    } else {
      this.closeSidebar();
    }
  }

  openSidebar() {
    log("Opening sidebar");

    // Show overlay first
    this.overlay.removeClass("hidden");

    // Force a reflow to ensure transition works
    this.overlay[0].offsetHeight;

    // Animate overlay and sidebar together
    requestAnimationFrame(() => {
      this.overlay.addClass("opacity-100");
      this.sidebar.removeClass("-translate-x-full").addClass("translate-x-0");

      $("body").addClass("overflow-hidden lg:overflow-auto");
    });

    log("Sidebar state after opening", {
      sidebarClasses: this.sidebar.attr("class"),
      overlayClasses: this.overlay.attr("class"),
      bodyClasses: $("body").attr("class"),
    });
  }

  closeSidebar() {
    log("Closing sidebar");

    // Start closing animation
    this.sidebar.removeClass("translate-x-0").addClass("-translate-x-full");

    this.overlay.removeClass("opacity-100");

    // Wait for animation to complete before hiding overlay
    const transitionEndHandler = () => {
      log("Transition ended, hiding overlay");
      this.overlay.addClass("hidden");
      this.overlay.off("transitionend", transitionEndHandler);
    };

    this.overlay.on("transitionend", transitionEndHandler);

    $("body").removeClass("overflow-hidden");

    log("Sidebar state after closing", {
      sidebarClasses: this.sidebar.attr("class"),
      overlayClasses: this.overlay.attr("class"),
      bodyClasses: $("body").attr("class"),
    });
  }

  // Add touch support for mobile
  initializeTouchEvents() {
    let touchStartX = 0;
    let touchEndX = 0;
    const SWIPE_THRESHOLD = 100; // minimum distance for swipe

    // Handle touch start
    document.addEventListener(
      "touchstart",
      (e) => {
        touchStartX = e.changedTouches[0].screenX;
      },
      { passive: true }
    );

    // Handle touch end
    document.addEventListener(
      "touchend",
      (e) => {
        touchEndX = e.changedTouches[0].screenX;
        this.handleSwipe(touchStartX, touchEndX);
      },
      { passive: true }
    );
  }

  handleSwipe(startX, endX) {
    const swipeDistance = endX - startX;

    // Swipe from left to right (open)
    if (swipeDistance > SWIPE_THRESHOLD && startX < 50) {
      log("Swipe right detected near left edge");
      this.openSidebar();
    }

    // Swipe from right to left (close)
    if (
      swipeDistance < -SWIPE_THRESHOLD &&
      this.sidebar.hasClass("translate-x-0")
    ) {
      log("Swipe left detected with open sidebar");
      this.closeSidebar();
    }
  }

  handleResize() {
    const width = $(window).width();
    log("Window resized", { newWidth: width });

    if (width >= 1024) {
      this.sidebar.removeClass("-translate-x-full translate-x-0");
      this.overlay.addClass("hidden opacity-0").removeClass("opacity-100");
      $("body").removeClass("overflow-hidden");
      log("Resize handled: desktop mode");
    } else {
      this.closeSidebar();
      log("Resize handled: mobile mode");
    }
  }
}

// Initialize when document is ready
$(document).ready(() => {
  log("Document ready, initializing sidebar");
  window.sidebarController = new SidebarController();
});
