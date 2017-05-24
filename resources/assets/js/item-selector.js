export default class ItemSelector {
  constructor() {
    this.selectedItems = [];

    this.init();
  }

  init() {
    this.handleCheckboxClick = this.handleCheckboxClick.bind(this);
    $('table').on('click', 'input[type="checkbox"]', this.handleCheckboxClick);

    this.handleLoadPage = this.handleLoadPage.bind(this);
    $('body').on('listLoaded', this.handleLoadPage);

    this.handleSelectAll = this.handleSelectAll.bind(this);
    $('#selectAll, #check-all').on('click', this.handleSelectAll);
  }

  handleCheckboxClick(evt) {
    const id = evt.target.value;

    if (!id || id === 'on') {
      return true;
    }

    this.storeSelectedItems();
    this.selectCheckAll();
  }

  handleSelectAll(evt) {
    const $target = $(evt.target);

    if ($target.hasClass('checkedAll')) {
      $('input[type="checkbox"]').prop('checked', false);
      $target.removeClass('checkedAll');
    } else {
      $('input[type="checkbox"]').prop('checked', true);
      $target.addClass('checkedAll');
    }

    this.storeSelectedItems();
  }

  handleLoadPage(evt, page) {
    $('table input[type="checkbox"]').each((index, el) => {
      const $input = $(el);

      if (!$input.val() || $input.val() === 'on') {
        return;
      }

      if (this.selectedItems.indexOf($input.val()) !== -1) {
        $input.prop('checked', true);
      }
    });

    this.selectCheckAll();
  }

  selectCheckAll() {
    let checkedAll = true;
    let checkboxLength = $('table input[type="checkbox"]').length;

    $('table input[type="checkbox"]').each((index, el) => {
      const $input = $(el);

      if (!$input.val() || $input.val() === 'on') {
        checkboxLength--;
        return;
      }

      if (!$input.prop('checked')) {
        checkedAll = false;
      }
    });

    $('#selectAll, #check-all').prop('checked', checkedAll && checkboxLength);
  }

  storeSelectedItems() {
    this.selectedItems = [];

    $('table input[type="checkbox"]:checked').each((index, el) => {
      const value = $(el).val();

      if (value || value === 'on') {
        this.selectedItems.push(value);
      }
    });
  }
}