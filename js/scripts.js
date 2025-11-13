/**
 * Main JavaScript file - Amorf's Blog Theme
 *
 * @package Amorfs_Blog
 */

(function ($) {
	"use strict";

	/**
	 * Mobile Menu Toggle
	 */
	function initMobileMenu() {
		var menuToggle = $(".mobile-menu-toggle");
		var menuClose = $(".mobile-menu-close");
		var navigation = $(".main-navigation");
		var overlay = $(".mobile-menu-overlay");
		var body = $("body");

		// Open menu
		menuToggle.on("click", function (e) {
			e.preventDefault();
			navigation.addClass("toggled");
			overlay.addClass("active");
			body.css("overflow", "hidden"); // Prevent body scroll

			$(this).attr("aria-expanded", "true");
			body.addClass("mobile-menu-open");
		});

		// Close menu function
		function closeMenu() {
			navigation.removeClass("toggled");
			overlay.removeClass("active");
			body.css("overflow", ""); // Restore body scroll

			menuToggle.attr("aria-expanded", "false");
			body.removeClass("mobile-menu-open");
		}

		// Close button click
		menuClose.on("click", function (e) {
			e.preventDefault();
			closeMenu();
		});

		// Close menu when clicking overlay
		overlay.on("click", function () {
			closeMenu();
		});

		// Close menu on escape key
		$(document).on("keydown", function (e) {
			if (e.key === "Escape" && navigation.hasClass("toggled")) {
				closeMenu();
			}
		});

		// Close menu when clicking menu links
		navigation.find(".nav-menu a").on("click", function () {
			closeMenu();
		});
	}

	/**
	 * Smooth Scroll for Anchor Links
	 */
	function initSmoothScroll() {
		$('a[href*="#"]')
			.not('[href="#"]')
			.not('[href="#0"]')
			.on("click", function (e) {
				var target = $(this.hash);

				if (target.length) {
					e.preventDefault();

					$("html, body").animate(
						{
							scrollTop: target.offset().top - 100,
						},
						500,
					);
				}
			});
	}

	/**
	 * Add class to header on scroll
	 */
	function initHeaderScroll() {
		var header = $(".site-header");
		var scrollThreshold = 50;

		$(window).on("scroll", function () {
			if ($(window).scrollTop() > scrollThreshold) {
				header.addClass("scrolled");
			} else {
				header.removeClass("scrolled");
			}
		});
	}

	/**
	 * Back to Top Button
	 */
	function initBackToTop() {
		// Create back to top button
		var backToTop = $("<button>", {
			id: "back-to-top",
			"aria-label": "Back to top",
			html: "↑",
		}).appendTo("body");

		// Show/hide button based on scroll position
		$(window).on("scroll", function () {
			if ($(window).scrollTop() > 300) {
				backToTop.addClass("visible");
			} else {
				backToTop.removeClass("visible");
			}
		});

		// Scroll to top on click
		backToTop.on("click", function () {
			$("html, body").animate(
				{
					scrollTop: 0,
				},
				600,
			);
		});
	}

	/**
	 * Add CSS for back to top button
	 */
	function addBackToTopStyles() {
		var styles = `
            #back-to-top {
                position: fixed;
                bottom: 2rem;
                right: 2rem;
                width: 50px;
                height: 50px;
                background: #2563EB;
                color: #fff;
                border: none;
                border-radius: 50%;
                cursor: pointer;
                font-size: 1.5rem;
                box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
                opacity: 0;
                visibility: hidden;
                transform: translateY(20px);
                transition: all 0.3s ease;
                z-index: 999;
            }
            
            #back-to-top.visible {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            
            #back-to-top:hover {
                background: #1D4ED8;
                transform: translateY(-4px);
                box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
            }
            
            @media (max-width: 767px) {
                #back-to-top {
                    bottom: 1rem;
                    right: 1rem;
                    width: 40px;
                    height: 40px;
                    font-size: 1.25rem;
                }
            }
        `;

		$("<style>").text(styles).appendTo("head");
	}

	/**
	 * Card Hover Animation Enhancement
	 */
	function initCardAnimations() {
		$(".blog-post-card, .recent-post-card").on("mouseenter", function () {
			$(this).addClass("hovered");
		});

		$(".blog-post-card, .recent-post-card").on("mouseleave", function () {
			$(this).removeClass("hovered");
		});
	}

	/**
	 * Newsletter Form Enhancement
	 */
	function initNewsletterForm() {
		var newsletterForm = $(".newsletter-form");

		newsletterForm.on("submit", function (e) {
			var emailInput = $(this).find(".newsletter-input");
			var email = emailInput.val().trim();

			// Basic email validation
			var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

			if (!emailRegex.test(email)) {
				e.preventDefault();
				emailInput.addClass("error");

				// Remove error class after 2 seconds
				setTimeout(function () {
					emailInput.removeClass("error");
				}, 2000);
			}
		});

		// Add error styling
		var errorStyles = `
            .newsletter-input.error {
                border: 2px solid #EF4444;
                animation: shake 0.5s;
            }
            
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
        `;

		$("<style>").text(errorStyles).appendTo("head");
	}

	/**
	 * Category Filter Active State (AJAX)
	 */
	function initCategoryFilter() {
		$(".category-list li a").on("click", function (e) {
			e.preventDefault();

			var $link = $(this);
			var $listItem = $link.parent();
			var categoryId = $link.data("category-id") || 0;

			// Update active state
			$(".category-list li").removeClass("active");
			$listItem.addClass("active");

			// Call AJAX filter
			filterPostsByCategory(categoryId, 1);
		});
	}

	/**
	 * AJAX Filter Posts by Category
	 */
	function filterPostsByCategory(categoryId, page) {
		var $blogGrid = $(".blog-grid-2col");
		var $pagination = $(".pagination");

		// Show loading state
		$blogGrid.addClass("loading").css("opacity", "0.5");
		if ($pagination.length) {
			$pagination.css("opacity", "1");
		}

		// Make AJAX request
		$.ajax({
			url: amorfsBlog.ajaxurl,
			type: "POST",
			data: {
				action: "filter_posts",
				nonce: amorfsBlog.nonce,
				category_id: categoryId,
				paged: page,
			},
			success: function (response) {
				if (response.success) {
					// Fade out
					$blogGrid.animate({ opacity: 0 }, 200, function () {
						// Update posts
						$blogGrid.html(response.posts);

						// Update pagination
						if (response.pagination) {
							if ($pagination.length) {
								$pagination.html($(response.pagination).html());
							} else {
								$blogGrid.after(response.pagination);
								$pagination = $(".pagination");
							}
						} else {
							$pagination.remove();
						}

						// Scroll to top of posts
						$("html, body").animate(
							{
								scrollTop: $blogGrid.offset().top - 100,
							},
							300,
						);

						// Fade in
						$blogGrid
							.removeClass("loading")
							.css("opacity", 0)
							.animate({ opacity: 1 }, 300);

						// Re-bind pagination clicks
						// bindPaginationClicks();
					});
				} else {
					$blogGrid.removeClass("loading").css("opacity", "1");
					showNotification("Error loading posts", "error");
				}
			},
			error: function () {
				$blogGrid.removeClass("loading").css("opacity", "1");
				showNotification("Error loading posts", "error");
			},
		});
	}

	/**
	 * Bind pagination clicks for AJAX
	 */
	function bindPaginationClicks() {
		$(document)
			.off("click", ".pagination a")
			.on("click", ".pagination a", function (e) {
				e.preventDefault();

				var $link = $(this);
				var href = $link.attr("href");

				// Extract page number from URL
				var pageMatch = href.match(/page\/(\d+)/);
				var page = pageMatch ? parseInt(pageMatch[1]) : 1;

				// Get current active category
				var $activeCategory = $(".category-list li.active a");
				var categoryId = $activeCategory.data("category-id") || 0;

				// Filter with the new page
				filterPostsByCategory(categoryId, page);
			});
	}

	/**
	 * Lazy Load Images
	 */
	function initLazyLoadImages() {
		if ("IntersectionObserver" in window) {
			var imageObserver = new IntersectionObserver(function (
				entries,
				observer,
			) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						var img = entry.target;
						img.src = img.dataset.src;
						img.classList.remove("lazy");
						imageObserver.unobserve(img);
					}
				});
			});

			document.querySelectorAll("img.lazy").forEach(function (img) {
				imageObserver.observe(img);
			});
		}
	}

	/**
	 * Reading Progress Bar
	 */
	function initReadingProgress() {
		if ($(".single-post-page").length) {
			// Create progress bar
			var progressBar = $("<div>", {
				id: "reading-progress",
			}).prependTo("body");

			// Calculate and update progress on scroll
			$(window).on("scroll", function () {
				var windowHeight = $(window).height();
				var documentHeight = $(document).height();
				var scrollTop = $(window).scrollTop();

				var progress =
					(scrollTop / (documentHeight - windowHeight)) * 100;
				progressBar.css("width", progress + "%");
			});

			// Add styles for progress bar
			var progressStyles = `
                #reading-progress {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 0%;
                    height: 3px;
                    background: linear-gradient(90deg, #2563EB, #60A5FA);
                    z-index: 9999;
                    transition: width 0.1s ease;
                }
            `;

			$("<style>").text(progressStyles).appendTo("head");
		}
	}

	/**
	 * External Links - Open in new tab
	 */
	function initExternalLinks() {
		$(".entry-content a").each(function () {
			var link = $(this);
			var href = link.attr("href");

			if (
				href &&
				href.indexOf(window.location.hostname) === -1 &&
				!href.startsWith("#") &&
				!href.startsWith("mailto:")
			) {
				link.attr("target", "_blank");
				link.attr("rel", "noopener noreferrer");
			}
		});
	}

	/**
	 * Search Form Enhancement
	 */
	function initSearchForm() {
		var searchForm = $(".search-form");
		var searchInput = searchForm.find('input[type="search"]');

		searchInput.on("focus", function () {
			searchForm.addClass("focused");
		});

		searchInput.on("blur", function () {
			if (!$(this).val()) {
				searchForm.removeClass("focused");
			}
		});
	}

	/**
	 * Newsletter Success/Error Messages
	 */
	function checkNewsletterStatus() {
		// Check URL parameters
		var urlParams = new URLSearchParams(window.location.search);
		var newsletterStatus = urlParams.get("newsletter");

		if (newsletterStatus === "success") {
			showNotification(
				"Thank you for subscribing to our newsletter!",
				"success",
			);
			// Remove parameter from URL
			window.history.replaceState(
				{},
				document.title,
				window.location.pathname,
			);
		} else if (newsletterStatus === "invalid") {
			showNotification("Please enter a valid email address.", "error");
			window.history.replaceState(
				{},
				document.title,
				window.location.pathname,
			);
		}
	}

	/**
	 * Show Notification
	 */
	function showNotification(message, type) {
		var notification = $("<div>", {
			class: "notification notification-" + type,
			text: message,
		}).appendTo("body");

		// Show notification
		setTimeout(function () {
			notification.addClass("show");
		}, 100);

		// Hide and remove notification after 5 seconds
		setTimeout(function () {
			notification.removeClass("show");
			setTimeout(function () {
				notification.remove();
			}, 300);
		}, 5000);

		// Add notification styles
		var notificationStyles = `
            .notification {
                position: fixed;
                bottom: 2rem;
                left: 50%;
                transform: translateX(-50%) translateY(100px);
                background: #2563EB;
                color: white;
                padding: 1rem 2rem;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 9999;
                opacity: 0;
                transition: all 0.3s ease;
                font-size: 14px;
                font-weight: 500;
            }
            
            .notification.show {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
            
            .notification-success {
                background: #10B981;
            }
            
            .notification-error {
                background: #EF4444;
            }
        `;

		if (!$("#notification-styles").length) {
			$("<style>", {
				id: "notification-styles",
			})
				.text(notificationStyles)
				.appendTo("head");
		}
	}

	/**
	 * Table of Contents Generator for Single Post
	 */
	function generateTableOfContents() {
		// Check if we're on a single post page
		if (!$(".single-post-page").length) {
			console.log("Not on single post page");
			return;
		}

		var toc = $("#table-of-contents");
		if (!toc.length) {
			console.log("TOC element not found");
			return;
		}

		// Find all h2 and h3 headings in article body
		var headings = $(".article-body-content h2, .article-body-content h3");

		console.log("Found " + headings.length + " headings");

		if (headings.length === 0) {
			// Hide sidebar if no headings
			$(".article-sidebar").hide();
			$(".article-layout").css("grid-template-columns", "1fr");
			return;
		}

		// Clear existing TOC
		toc.empty();

		// Generate TOC items
		headings.each(function (index) {
			var heading = $(this);
			var headingText = heading.text().trim();
			var headingId = "toc-heading-" + index;

			// Skip if heading is empty
			if (!headingText) {
				return;
			}

			// Add ID to heading for anchor link
			heading.attr("id", headingId);

			// Create TOC item
			var tocItem = $("<li>");
			var tocLink = $("<a>", {
				href: "#" + headingId,
				text: headingText,
				class: heading.is("h3") ? "toc-h3" : "toc-h2",
			});

			tocItem.append(tocLink);
			toc.append(tocItem);
		});

		console.log("TOC generated with " + toc.find("li").length + " items");

		// Highlight active section on scroll
		var scrollTimeout;
		$(window).on("scroll", function () {
			clearTimeout(scrollTimeout);
			scrollTimeout = setTimeout(function () {
				var scrollPos = $(window).scrollTop() + 150;
				var activeHeading = null;

				// Find the current active heading
				headings.each(function () {
					var heading = $(this);
					var headingTop = heading.offset().top;

					if (scrollPos >= headingTop - 50) {
						activeHeading = heading;
					}
				});

				// Remove all active classes
				toc.find("a").removeClass("active");

				// Add active class to current heading
				if (activeHeading) {
					var headingId = activeHeading.attr("id");
					toc.find('a[href="#' + headingId + '"]').addClass("active");
				}

				// If scrolled to top, remove all active
				if (scrollPos < 100) {
					toc.find("a").removeClass("active");
					// Activate first item
					toc.find("a").first().addClass("active");
				}
			}, 50);
		});

		// Trigger initial scroll to set active item
		$(window).trigger("scroll");
	}

	/**
	 * Bookmark Button Toggle
	 */
	function initBookmarkButton() {
		$(".bookmark-btn").on("click", function () {
			$(this).toggleClass("bookmarked");

			var svg = $(this).find("svg");
			if ($(this).hasClass("bookmarked")) {
				svg.attr("fill", "currentColor");
				showNotification("Đã thêm vào bookmark!", "success");
			} else {
				svg.attr("fill", "none");
				showNotification("Đã xóa khỏi bookmark", "success");
			}
		});
	}

	/**
	 * Copy Link Notification
	 */
	function initCopyLinkFeedback() {
		$(".copy-link").on("click", function () {
			var btn = $(this);
			setTimeout(function () {
				showNotification("Link copied!", "success");
			}, 100);

			// Reset icon after 2 seconds
			setTimeout(function () {
				btn.removeClass("copied");
			}, 2000);
		});
	}

	/**
	 * Related Posts Carousel Navigation
	 */
	function initRelatedPostsNav() {
		var prevBtn = $(
			".related-posts-section-fullwidth .related-posts-nav-btn.prev",
		);
		var nextBtn = $(
			".related-posts-section-fullwidth .related-posts-nav-btn.next",
		);
		var grid = $(".related-posts-section-fullwidth .related-posts-grid");

		if (!grid.length) {
			return;
		}

		// Calculate scroll amount dynamically
		function getScrollAmount() {
			var card = grid.find(".related-post-card").first();
			if (card.length) {
				return card.outerWidth(true); // includes gap
			}
			return 400;
		}

		prevBtn.on("click", function (e) {
			e.preventDefault();
			if (grid.is(":animated")) return; // Prevent multiple clicks
			var scrollAmount = getScrollAmount();
			var currentScroll = grid.scrollLeft();
			grid.animate(
				{
					scrollLeft: currentScroll - scrollAmount,
				},
				300,
				"swing",
				updateNavButtons,
			);
		});

		nextBtn.on("click", function (e) {
			e.preventDefault();
			if (grid.is(":animated")) return; // Prevent multiple clicks
			var scrollAmount = getScrollAmount();
			var currentScroll = grid.scrollLeft();
			grid.animate(
				{
					scrollLeft: currentScroll + scrollAmount,
				},
				300,
				"swing",
				updateNavButtons,
			);
		});

		// Update button states
		function updateNavButtons() {
			var scrollLeft = Math.round(grid.scrollLeft());
			var scrollWidth = grid[0].scrollWidth;
			var clientWidth = grid[0].clientWidth;
			var maxScroll = scrollWidth - clientWidth;

			// At start
			if (scrollLeft <= 5) {
				prevBtn.prop("disabled", true).css("opacity", "0.3");
			} else {
				prevBtn.prop("disabled", false).css("opacity", "1");
			}

			// At end
			if (scrollLeft >= maxScroll - 5) {
				nextBtn.prop("disabled", true).css("opacity", "0.3");
			} else {
				nextBtn.prop("disabled", false).css("opacity", "1");
			}

			// Hide buttons if all content visible
			if (scrollWidth <= clientWidth + 10) {
				prevBtn.css("display", "none");
				nextBtn.css("display", "none");
			} else {
				prevBtn.css("display", "flex");
				nextBtn.css("display", "flex");
			}
		}

		grid.on("scroll", updateNavButtons);
		$(window).on("resize", updateNavButtons);
		setTimeout(updateNavButtons, 300);
		$(window).on("load", updateNavButtons);
	}

	/**
	 * Add Figure Captions to Images
	 */
	function enhanceContentImages() {
		$(".article-body-content img").each(function () {
			var img = $(this);
			var alt = img.attr("alt");

			// Skip if already in a figure
			if (img.parent().is("figure")) {
				return;
			}

			// If image has alt text, wrap in figure with caption
			if (alt && alt !== "") {
				img.wrap('<figure class="wp-block-image"></figure>');
				img.after(
					'<figcaption class="wp-element-caption">' +
						alt +
						"</figcaption>",
				);
			}
		});
	}

	/**
	 * Estimated Reading Time Scroll
	 */
	function updateReadingTime() {
		if (!$(".single-post-page").length) return;

		var totalWords = $(".article-body-content").text().split(/\s+/).length;
		var wordsPerMinute = 200;
		var totalMinutes = Math.ceil(totalWords / wordsPerMinute);

		$(window).on("scroll", function () {
			var scrollPercent =
				($(window).scrollTop() /
					($(document).height() - $(window).height())) *
				100;
			var minutesRead = Math.ceil((scrollPercent / 100) * totalMinutes);

			if (minutesRead < totalMinutes) {
				var timeLeft = totalMinutes - minutesRead;
				// You can update a reading time indicator here if needed
			}
		});
	}

	/**
	 * Smooth Scroll Enhancement for TOC
	 */
	function enhanceTOCScroll() {
		$(".toc-list a, .back-to-top, .back-to-top-btn").on(
			"click",
			function (e) {
				e.preventDefault();
				var href = $(this).attr("href");
				var target = $(href);

				if (href === "#top" || target.length === 0) {
					$("html, body").animate(
						{
							scrollTop: 0,
						},
						600,
						"swing",
					);
				} else if (target.length) {
					$("html, body").animate(
						{
							scrollTop: target.offset().top - 100,
						},
						600,
						"swing",
					);
				}
			},
		);
	}

	/**
	 * Print Article Button (Optional)
	 */
	function initPrintButton() {
		// You can add a print button if needed
		$(".print-article").on("click", function () {
			window.print();
		});
	}

	/**
	 * Social Share Tracking (Optional)
	 */
	function trackSocialShares() {
		$(".social-icon, .share-icon-btn").on("click", function () {
			var platform = "unknown";
			if (
				$(this).hasClass("facebook-share") ||
				$(this).hasClass("facebook")
			) {
				platform = "facebook";
			} else if (
				$(this).hasClass("twitter-share") ||
				$(this).hasClass("twitter")
			) {
				platform = "twitter";
			}

			// You can send analytics here
			console.log("Shared on: " + platform);
		});
	}

	/**
	 * Initialize all functions
	 */
	$(document).ready(function () {
		initMobileMenu();
		initSmoothScroll();
		initHeaderScroll();
		addBackToTopStyles();
		initBackToTop();
		initCardAnimations();
		initNewsletterForm();
		initCategoryFilter();
		bindPaginationClicks();
		initExternalLinks();
		initSearchForm();
		initReadingProgress();
		checkNewsletterStatus();

		// Single post specific functions
		generateTableOfContents();
		initBookmarkButton();
		initCopyLinkFeedback();
		initRelatedPostsNav();
		enhanceContentImages();
		updateReadingTime();
		enhanceTOCScroll();
		trackSocialShares();
	});

	/**
	 * Window resize handler
	 */
	var resizeTimer;
	$(window).on("resize", function () {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function () {
			// Close mobile menu on desktop
			if (window.innerWidth >= 768) {
				$(".main-navigation").removeClass("toggled");
				$(".mobile-menu-overlay").removeClass("active");
				$(".mobile-menu-toggle").attr("aria-expanded", "false");
				$("body").css("overflow", ""); // Restore body scroll
			}
		}, 250);
	});

	/**
	 * Window load handler
	 */
	$(window).on("load", function () {
		// Remove loading class from body if present
		$("body").removeClass("loading");

		// Trigger scroll event to check header state
		$(window).trigger("scroll");

		// Initialize lazy loading
		initLazyLoadImages();
	});
})(jQuery);
