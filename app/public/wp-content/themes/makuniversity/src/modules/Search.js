import $ from 'jquery';

class Search {
    // 1. properties
    constructor() {
        this.addSearchHtml();

        this.openButton = $('.js-search-trigger');
        this.closeButton = $('.search-overlay__close');
        this.searchOverlay = $('.search-overlay');
        this.resultsDiv = $('#search-overlay__results');
        this.searchField = $('#search-term');
        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.typingTimer;
        this.previousValue;

        this.events();
    };

    // 2. events
    events = () => {
        this.openButton.on('click', this.openOverlay.bind(this));
        this.closeButton.on('click', this.closeOverlay.bind(this));
        $(document).on('keydown', this.keyPressDispatcher.bind(this));
        this.searchField.on('keyup', this.typingLogic.bind(this));
    };

    // 3. methods
    addSearchHtml = () => {
        $('body').append(`
        <div class="search-overlay">
            <div class="search-overlay__top">
                <div class="container">
                    <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                    <input id="search-term" autocomplete="off" type="text" class="search-term" placeholder="What are you looking for?" />
                    <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
                </div>
            </div>
            <div class="container">
                <div id="search-overlay__results">
                    
                </div>
            </div>
        </div>
        `);
    };

    openOverlay = () => {
        this.searchOverlay.addClass('search-overlay--active');
        $('body').addClass('body-no-scroll');
        this.isOverlayOpen = true;
        this.searchField.val('');
        setTimeout(() => {
            this.searchField.focus();
        }, 300)
    };

    typingLogic = () => {
        if (this.searchField.val() !== this.previousValue) {
            clearTimeout(this.typingTimer);

            if (this.searchField.val()) {
                if (!this.isSpinnerVisible) {
                    this.resultsDiv.html('<div class="spinner-loader"></div>');
                    this.isSpinnerVisible = true;
                }

                this.typingTimer = setTimeout(this.getResults.bind(this), 750);
            } else {
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;
            }
        }

        this.previousValue = this.searchField.val();
    };

    getResults = () => {
        $.when(
            $.getJSON(`${universityData.root_url}/wp-json/wp/v2/search?search=${this.searchField.val()}`)
        ).then(posts => {
            console.log(posts)
            this.resultsDiv.html(`
                <h2 class="search-overlay__section-title">Gemeral Information</h2>
                ${posts.length ? '<ul class="link-list min-list">' : '<p>No general information mathces the search</p>'}
                <ul class="link-list min-list">
                    ${posts.map(post => (
                    `<li><a href="${post.url}">${post.title}</a></li>`
                )).join('')}
                ${'</ul>'}
            `);
        }, (error) => {
            console.log(`An error ${error} occured`);
            this.resultsDiv.html(`<p>Unexpected error, please try again</p>`);
        });

        this.isSpinnerVisible = false;
    };

    closeOverlay = () => {
        this.searchOverlay.removeClass('search-overlay--active');
        $('body').removeClass('body-no-scroll');
        this.isOverlayOpen = false;
    };

    keyPressDispatcher = (e) => {
        if (e.keyCode === 83 &&
            !this.isOverlayOpen &&
            !$('input, textarea').is(':focus')) {
            this.openOverlay();
        }

        if (e.keyCode === 27 && this.isOverlayOpen) {
            this.closeOverlay();
        }
    };
}

export default Search;