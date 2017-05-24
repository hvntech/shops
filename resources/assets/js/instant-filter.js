export default class InstantFilter {
  constructor(Soccast) {
    this.Soccast = Soccast;

    this.init();
  }

  init() {
    this.currentPage = this.Soccast.currentPage;
    this.requestTimer = null;
    this.isLoading = false;

    this.$fields = $('[data-field]');
    this.$sortColumns = $('[data-sort]');

    // Fill search fields with old data
    this.fillFields();

    this.handleEvents();

    this.request();
  }

  fillFields() {
    // Fill out search fields
    const fieldValues = this.Soccast.fields;
    if ($.isPlainObject(fieldValues)) {
      this.$fields.each((index, input) => {
        const $input = $(input);

        if (typeof fieldValues[$input.data('field')] !== 'undefined') {
            $input.val(fieldValues[$input.data('field')]);
        }
      });
    }

    // Fill out sort columns
    const sorts = this.Soccast.sorts;

    // Reset existing sort if multipleSort is enabled
    if (!$.isEmptyObject(sorts) && this.Soccast.multipleSort !== true) {
        this.$sortColumns.each((index, column) => $(column).data('direction', null));
    }

    if ($.isPlainObject(sorts)) {
      this.$sortColumns.each((index, column) => {
        const $column = $(column);

        if (typeof sorts[$column.data('sort')] !== 'undefined') {
          $column.data('direction', sorts[$column.data('sort')]);
        }
      });
    }

    this.updateSortColumns();
  }

  handleEvents() {
    // Handle search field change
    this.$fields.on('keyup change', evt => {
      const $this = $(evt.target);

      if ($this.data('oldValue') === $this.val()) {
        return true;
      }

      $this.data('oldValue', $this.val());

      clearTimeout(this.requestTimer);

      this.requestTimer = setTimeout(() => this.request(), 300);
    });

    // Handle click on pagination
    $('#pagination').on('click', '[data-page]', evt => {
      evt.preventDefault();

      this.currentPage = $(evt.target).data('page');

      this.request();
    });

    // Handle sort
    this.$sortColumns.on('click', evt => {
      evt.preventDefault();

      const $column = $(evt.target).closest('th');
      let direction = $column.data('direction');

      if (this.Soccast.multipleSort !== true) {
        this.$sortColumns.each((index, column) => $(column).data('direction', null));
      }

      if (!direction || 'desc' === direction) {
        direction = 'asc';
      } else {
        direction = 'desc';
      }

      $column.data('direction', direction);

      this.updateSortColumns();

      this.request();
    });
  }

  request(params) {
    if (this.isLoading) {
      return;
    }

    params = params || this.prepareParams();

    this.isLoading = true;
    $('.template-wrapper').addClass('loading');

    $.ajax({
      url: this.Soccast.searchUrl,
      method: 'GET',
      data: params,
      success: response => {
        for (const template in response.templates) {
          $('#' + template).html(response.templates[template]);
        }

        history.pushState(null, null, response.url);

        $('body').trigger('listLoaded', this.currentPage);
      },
      complete: () => {
        this.isLoading = false;
        $('.template-wrapper').removeClass('loading');
      },
      error: () => {
        //@todo: show alert when error occurs
      }
    });
  }

  prepareParams() {
    const params = {
      fields: {},
      sorts: {},
      page: this.currentPage
    };

    // Generate search fields from inputs
    this.$fields.each((index, input) => {
      const $input = $(input);

      params.fields[$input.data('field')] = $input.val();
    });

    // Generate sort columns
    this.$sortColumns.each((index, column) => {
      const $column = $(column);

      if ($column.data('direction')) {
        params.sorts[$column.data('sort')] = $column.data('direction');
      }
    });

    return params;
  }

  /**
   * Update UI of columns to display current direction
   */
  updateSortColumns() {
    this.$sortColumns.each((index, column) => {
      const $column = $(column);
      const sort = $column.data('sort');
      const direction = $column.data('direction');

      $column.removeClass('sort-none sort-asc sort-desc');

      if ('asc' === direction) {
        $column.addClass('sort-asc');
      } else if ('desc' === direction) {
        $column.addClass('sort-desc');
      } else {
        $column.addClass('sort-none');
      }
    });
  }
}
