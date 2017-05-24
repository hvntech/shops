import InstantFilter from './instant-filter';
import ItemSelector from './item-selector';

window.Soccast = window.Soccast || {};

jQuery(document).ready(() => {
  if (Soccast.searchList) {
    new InstantFilter(Soccast);
  }

  new ItemSelector();

  $('#logout').on('click', (e) => {
    e.preventDefault();
    if (confirm('Do you want to logout ?')) {
      window.location = e.target.href;
    }
  });
});