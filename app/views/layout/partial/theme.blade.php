<p><strong>Theme</strong></p>
<div class="btn-group dropup">
  <button type="button" class="btn btn-default btn-sm btn-info theme-name">{{strlen(Cookie::get('theme')) == 0 ? 'Default' : ucwords(Cookie::get('theme'))}}</button>
  <button type="button" class="btn btn-default btn-info dropdown-toggle btn-sm" data-toggle="dropdown">
    <span class="caret"></span>
    <span class="sr-only">Toggle Theme Dropdown</span>
  </button>
  <ul class="dropdown-menu theme-list" >
    <li><a href="#" data-name="default">Default</a></li>
    <li><a href="#" data-name="amelia">Amelia</a></li>
    <li><a href="#" data-name="cerulean">Cerulean</a></li>
    <li><a href="#" data-name="cyborg">Cyborg</a></li>
    <li><a href="#" data-name="darkly">Darkly</a></li>
    <li><a href="#" data-name="flatly">Flatly</a></li>
    <li><a href="#" data-name="journal">Journal</a></li>
    <li><a href="#" data-name="lumen">Lumen</a></li>
    <li><a href="#" data-name="readable">Readable</a></li>
    <li><a href="#" data-name="shamrock">Shamrock</a></li>
    <li><a href="#" data-name="simplex">Simplex</a></li>
    <li><a href="#" data-name="slate">Slate</a></li>
    <li><a href="#" data-name="spacelab">Spacelab</a></li>
    <li><a href="#" data-name="superhero">Superhero</a></li>
    <li><a href="#" data-name="united">United</a></li>
    <li><a href="#" data-name="yeti">Yeti</a></li>
  </ul>
</div>