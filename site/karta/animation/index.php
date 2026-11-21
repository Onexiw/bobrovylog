<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle(GetMessage("finpark_map"));
?>
<style>
  .map-model {
    --map-blue: #6C9ABF;
    --map-blue-dark: #006E95;
    --map-deep-blue: #005481;
    --map-purple: #751F66;
    --map-text: #333;
    --map-muted: #777;
    --map-border: #e1e6ea;
    padding: 30px;
    color: var(--map-text);
    font-family: 'Cera Pro', Arial, sans-serif;
  }
  .map-model *, .map-model *::before, .map-model *::after { box-sizing: border-box; }
  .map-model__heading {
    display: flex;
    justify-content: space-between;
    align-items: end;
    gap: 20px;
    margin: 0 0 20px;
  }
  .map-model__eyebrow {
    margin: 0 0 6px;
    color: var(--map-purple);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
  }
  .map-model h1 {
    margin: 0;
    color: var(--map-blue-dark);
    font-family: 'BebasNeueBold', 'Cera Pro', sans-serif;
    font-size: clamp(34px, 4vw, 54px);
    font-weight: 400;
    line-height: .96;
    text-transform: uppercase;
  }
  .map-model__subtitle { margin: 8px 0 0; color: var(--map-muted); font-size: 14px; }
  .map-model__season {
    flex: 0 0 auto;
    padding: 9px 14px;
    border: 1px solid #d7e4ee;
    border-radius: 18px;
    background: #f2f7fa;
    color: var(--map-deep-blue);
    font-size: 12px;
    font-weight: 700;
  }
  .map-model__workspace {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 285px;
    min-height: 560px;
    overflow: hidden;
    border: 1px solid var(--map-border);
    border-radius: 8px;
    background: #fff;
  }
  .map-model__stage { position: relative; min-width: 0; background: #dce7ed; }
  .map-model__toolbar {
    position: absolute;
    z-index: 3;
    top: 14px;
    left: 14px;
    right: 14px;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
  }
  .map-model__filters, .map-model__zoom {
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 4px;
    border: 1px solid rgba(0, 84, 129, .15);
    border-radius: 6px;
    background: rgba(255,255,255,.96);
    box-shadow: 0 2px 8px rgba(0, 49, 76, .10);
  }
  .map-model__filter, .map-model__zoom-button {
    border: 0;
    border-radius: 4px;
    background: transparent;
    color: #4c5961;
    cursor: pointer;
    font-family: 'Cera Pro', Arial, sans-serif;
  }
  .map-model__filter { padding: 8px 10px; font-size: 11px; font-weight: 700; }
  .map-model__filter[aria-pressed="true"] { background: var(--map-blue); color: #fff; }
  .map-model__filter:focus-visible, .map-model__zoom-button:focus-visible, .map-model__pin:focus-visible {
    outline: 2px solid var(--map-purple);
    outline-offset: 2px;
  }
  .map-model__zoom-button { width: 30px; height: 30px; font-size: 19px; line-height: 1; }
  .map-model__zoom-value { min-width: 40px; color: var(--map-muted); font-size: 10px; text-align: center; }
  .map-model__viewport {
    position: relative;
    width: 100%;
    aspect-ratio: 1290 / 1038;
    min-height: 560px;
    overflow: hidden;
  }
  .map-model__canvas { position: absolute; inset: 0; transform-origin: 52% 54%; }
  .map-model__image { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: fill; user-select: none; }
  .map-model__pin {
    position: absolute;
    z-index: 2;
    left: var(--x);
    top: var(--y);
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 0;
    border: 0;
    background: transparent;
    color: #fff;
    cursor: pointer;
    text-align: left;
    transform: translate(-50%, -50%);
  }
  .map-model__pin[hidden] { display: none; }
  .map-model__pin-dot {
    position: relative;
    display: grid;
    flex: 0 0 32px;
    width: 32px;
    height: 32px;
    place-items: center;
    border: 2px solid #fff;
    border-radius: 50%;
    background: var(--map-blue);
    box-shadow: 0 2px 8px rgba(0, 49, 76, .25);
    font-size: 13px;
    font-weight: 700;
  }
  .map-model__pin[data-kind="slope"] .map-model__pin-dot { background: #df4848; }
  .map-model__pin[data-kind="lift"] .map-model__pin-dot { background: #43a648; }
  .map-model__pin[aria-current="true"] .map-model__pin-dot { outline: 3px solid rgba(0, 84, 129, .35); outline-offset: 2px; }
  .map-model__pin-label {
    padding: 7px 9px;
    border-radius: 4px;
    background: rgba(0, 84, 129, .92);
    font-size: 11px;
    font-weight: 700;
    line-height: 1.15;
    white-space: nowrap;
  }
  .map-model__pin[data-kind="slope"] .map-model__pin-label { background: rgba(194, 58, 58, .94); }
  .map-model__pin[data-kind="lift"] .map-model__pin-label { background: rgba(52, 127, 57, .94); }
  .map-model__caption {
    position: absolute;
    z-index: 3;
    bottom: 14px;
    left: 14px;
    padding: 8px 10px;
    border: 1px solid rgba(0, 84, 129, .15);
    border-radius: 5px;
    background: rgba(255,255,255,.95);
    color: #59676f;
    font-size: 11px;
  }
  .map-model__panel { display: flex; flex-direction: column; padding: 24px 20px; background: #fff; }
  .map-model__panel-kicker { color: var(--map-muted); font-size: 10px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; }
  .map-model__selected-icon {
    display: grid;
    width: 46px;
    height: 46px;
    place-items: center;
    margin: 22px 0 14px;
    border-radius: 5px;
    background: #edf4f8;
    color: var(--map-blue-dark);
    font-size: 21px;
    font-weight: 700;
  }
  .map-model__panel h2 {
    margin: 0;
    color: var(--map-blue-dark);
    font-family: 'BebasNeueBold', 'Cera Pro', sans-serif;
    font-size: 27px;
    font-weight: 400;
    line-height: 1;
    text-transform: uppercase;
  }
  .map-model__description { min-height: 65px; margin: 10px 0 16px; color: #5f686e; font-size: 13px; line-height: 1.5; }
  .map-model__facts { margin: 0; padding: 0; list-style: none; border-top: 1px solid var(--map-border); }
  .map-model__facts li { display: flex; justify-content: space-between; gap: 10px; padding: 10px 0; border-bottom: 1px solid var(--map-border); color: var(--map-muted); font-size: 11px; }
  .map-model__facts strong { color: var(--map-text); font-size: 11px; text-align: right; }
  .map-model__classic-link {
    display: flex;
    justify-content: center;
    margin: 18px 0 0;
    padding: 11px 12px;
    border-radius: 4px;
    background: var(--map-blue);
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
  }
  .map-model__classic-link:hover, .map-model__classic-link:focus { background: var(--map-deep-blue); color: #fff; text-decoration: none; }
  .map-model__legend { margin-top: auto; padding-top: 24px; }
  .map-model__legend-title { margin-bottom: 10px; color: var(--map-muted); font-size: 10px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; }
  .map-model__legend-items { display: grid; grid-template-columns: 1fr 1fr; gap: 9px 6px; }
  .map-model__legend-item { display: flex; align-items: center; gap: 7px; color: #5f686e; font-size: 10px; }
  .map-model__legend-dot { width: 8px; height: 8px; border-radius: 50%; background: #df4848; }
  .map-model__legend-dot--lift { background: #43a648; }
  .map-model__legend-dot--place { background: var(--map-blue); }
  .map-model__note { margin: 14px 0 0; color: #858c91; font-size: 10px; line-height: 1.5; }
  .map-model__mobile-info { display: none; }
  body.map-model-embed .header, body.map-model-embed .footer, body.map-model-embed .also, body.map-model-embed .events, body.map-model-embed .cookie { display: none !important; }
  body.map-model-embed .content { padding-left: 0 !important; }
  body.map-model-embed .map-model { height: 100vh; padding: 16px; }
  body.map-model-embed .map-model__workspace { min-height: calc(100vh - 120px); }
  @media (max-width: 900px) {
    .map-model { padding: 24px 18px; }
    .map-model__workspace { grid-template-columns: minmax(0, 1fr) 250px; }
    .map-model__panel { padding: 20px 16px; }
    .map-model__filter { padding: 8px; }
  }
  @media (max-width: 700px) {
    .map-model { padding: 20px 12px; }
    .map-model__heading { align-items: start; }
    .map-model__workspace { display: block; min-height: 0; }
    .map-model__viewport { height: min(58vh, 520px); min-height: 0; aspect-ratio: auto; }
    .map-model__canvas { left: -42%; width: 184%; }
    .map-model__filters { max-width: calc(100% - 92px); overflow-x: auto; }
    .map-model__filter { flex: 0 0 auto; font-size: 10px; }
    .map-model__pin-label { display: none; }
    .map-model__pin[aria-current="true"] .map-model__pin-label { position: absolute; left: 25px; display: block; }
    .map-model__panel { display: none; }
    .map-model__mobile-info { display: flex; align-items: center; gap: 12px; padding: 15px; border-top: 1px solid var(--map-border); background: #fff; }
    .map-model__mobile-copy { min-width: 0; flex: 1; }
    .map-model__mobile-copy strong { display: block; color: var(--map-blue-dark); font-family: 'BebasNeueBold', 'Cera Pro', sans-serif; font-size: 20px; font-weight: 400; text-transform: uppercase; }
    .map-model__mobile-copy small { display: block; overflow: hidden; color: #5f686e; font-size: 11px; text-overflow: ellipsis; white-space: nowrap; }
    .map-model__mobile-more { border: 0; background: transparent; color: var(--map-blue-dark); font-size: 11px; font-weight: 700; }
    .map-model__mobile-detail { display: none; flex: 0 0 100%; padding-left: 58px; color: #5f686e; font-size: 12px; line-height: 1.5; }
    .map-model__mobile-info.is-open { flex-wrap: wrap; }
    .map-model__mobile-info.is-open .map-model__mobile-detail { display: block; }
    .map-model__mobile-link { display: inline-block; margin-top: 8px; color: var(--map-blue-dark); font-size: 11px; font-weight: 700; }
    body.map-model-embed .map-model { padding: 8px; }
    body.map-model-embed .map-model__heading { display: none; }
    body.map-model-embed .map-model__viewport { height: min(68vh, 560px); }
    body.map-model-embed .map-model__workspace { min-height: 0; }
  }
</style>
<script>
  if (new URLSearchParams(window.location.search).get('embed') === '1') {
    document.body.classList.add('map-model-embed');
  }
</script>

<main class="map-model">
  <header class="map-model__heading">
    <div>
      <p class="map-model__eyebrow">Фанпарк «Бобровый лог»</p>
      <h1>Карта фанпарка</h1>
      <p class="map-model__subtitle">Выберите объект на зимней схеме, чтобы посмотреть подробности.</p>
    </div>
    <span class="map-model__season">Зимняя схема</span>
  </header>

  <section class="map-model__workspace" aria-label="Интерактивная карта фанпарка">
    <div class="map-model__stage">
      <div class="map-model__toolbar">
        <div class="map-model__filters" role="group" aria-label="Фильтр объектов">
          <button class="map-model__filter" type="button" data-filter="all" aria-pressed="true">Все объекты</button>
          <button class="map-model__filter" type="button" data-filter="slope" aria-pressed="false">Трассы</button>
          <button class="map-model__filter" type="button" data-filter="lift" aria-pressed="false">Подъёмники</button>
          <button class="map-model__filter" type="button" data-filter="place" aria-pressed="false">Места</button>
        </div>
        <div class="map-model__zoom" aria-label="Масштаб карты">
          <button class="map-model__zoom-button" type="button" data-zoom="out" aria-label="Уменьшить">−</button>
          <span class="map-model__zoom-value" id="map-zoom-value">100%</span>
          <button class="map-model__zoom-button" type="button" data-zoom="in" aria-label="Увеличить">+</button>
        </div>
      </div>
      <div class="map-model__viewport">
        <div class="map-model__canvas" id="map-canvas">
          <img class="map-model__image" src="assets/map-base.jpg" alt="Зимняя карта склонов и объектов фанпарка" draggable="false">
          <button class="map-model__pin" style="--x:33%;--y:13%" data-kind="place" data-icon="⌃" data-title="Вершина Такмак" data-copy="Начало горного дня и панорамный вид на окрестности." data-facts="Высота|517 м" aria-current="true"><span class="map-model__pin-dot">⌃</span><span class="map-model__pin-label">Такмак</span></button>
          <button class="map-model__pin" style="--x:37%;--y:43%" data-kind="slope" data-icon="1" data-title="Горнолыжные трассы" data-copy="На схеме показаны трассы разного уровня сложности. Перед катанием уточните их открытие на сайте фанпарка." data-facts="На схеме|Трассы 1–14"><span class="map-model__pin-dot">1</span><span class="map-model__pin-label">Трассы 1–14</span></button>
          <button class="map-model__pin" style="--x:40%;--y:59%" data-kind="lift" data-icon="↟" data-title="Подъёмник К1" data-copy="Нижняя станция подъёмника рядом с учебной зоной." data-facts="Рядом|Школа катания"><span class="map-model__pin-dot">↟</span><span class="map-model__pin-label">К1</span></button>
          <button class="map-model__pin" style="--x:63%;--y:59%" data-kind="lift" data-icon="↟" data-title="Подъёмник К2" data-copy="Нижняя станция у комплекса «Мираж»." data-facts="Ориентир|Комплекс «Мираж»"><span class="map-model__pin-dot">↟</span><span class="map-model__pin-label">К2</span></button>
          <button class="map-model__pin" style="--x:75%;--y:40%" data-kind="place" data-icon="✦" data-title="Сноупарк" data-copy="Зона для катания и трюков на сноуборде и лыжах." data-facts="Зона|Активный отдых"><span class="map-model__pin-dot">✦</span><span class="map-model__pin-label">Сноупарк</span></button>
          <button class="map-model__pin" style="--x:52%;--y:60%" data-kind="place" data-icon="⌂" data-title="Сервис-центр «Оазис»" data-copy="Зона сервиса и отдыха у нижних станций подъёмников." data-facts="Зона|Сервис и отдых"><span class="map-model__pin-dot">⌂</span><span class="map-model__pin-label">«Оазис»</span></button>
          <button class="map-model__pin" style="--x:42%;--y:78%" data-kind="place" data-icon="◉" data-title="Бобровый остров" data-copy="Пространство для прогулок и отдыха у реки Базаиха." data-facts="Зона|Прогулки и отдых"><span class="map-model__pin-dot">◉</span><span class="map-model__pin-label">Бобровый остров</span></button>
          <button class="map-model__pin" style="--x:26%;--y:55%" data-kind="place" data-icon="✚" data-title="Школа катания" data-copy="Учебная зона у нижней станции. На исходной схеме указана школа им. В. И. Махова." data-facts="Зона|Обучение катанию"><span class="map-model__pin-dot">✚</span><span class="map-model__pin-label">Школа катания</span></button>
        </div>
      </div>
      <div class="map-model__caption">Схема по баннеру · Нажмите на маркер для выбора объекта</div>
    </div>

    <aside class="map-model__panel" aria-live="polite">
      <div class="map-model__panel-kicker">Выбранный объект</div>
      <div class="map-model__selected-icon" id="selected-icon">⌃</div>
      <h2 id="selected-title">Вершина Такмак</h2>
      <p class="map-model__description" id="selected-copy">Начало горного дня и панорамный вид на окрестности.</p>
      <ul class="map-model__facts" id="selected-facts"><li><span>Высота</span><strong>517 м</strong></li></ul>
      <a class="map-model__classic-link" href="/karta/karta-fanparka.html">Классическая карта</a>
      <div class="map-model__legend">
        <div class="map-model__legend-title">Обозначения</div>
        <div class="map-model__legend-items">
          <div class="map-model__legend-item"><i class="map-model__legend-dot"></i>Трассы</div>
          <div class="map-model__legend-item"><i class="map-model__legend-dot map-model__legend-dot--lift"></i>Подъёмники</div>
          <div class="map-model__legend-item"><i class="map-model__legend-dot map-model__legend-dot--place"></i>Места</div>
        </div>
        <p class="map-model__note">Схема показывает расположение объектов. Актуальные режимы работы смотрите на классической карте и сайте фанпарка.</p>
      </div>
    </aside>

    <div class="map-model__mobile-info" aria-live="polite">
      <div class="map-model__selected-icon" id="mobile-icon">⌃</div>
      <div class="map-model__mobile-copy"><strong id="mobile-title">Вершина Такмак</strong><small id="mobile-copy">Начало горного дня и панорамный вид</small></div>
      <button class="map-model__mobile-more" type="button" id="mobile-more" aria-expanded="false">Подробнее</button>
      <div class="map-model__mobile-detail" id="mobile-detail"><span id="mobile-long-copy">Начало горного дня и панорамный вид на окрестности.</span><br><a class="map-model__mobile-link" href="/karta/karta-fanparka.html">Открыть классическую карту</a></div>
    </div>
  </section>
</main>

<script>
(function () {
  var pins = Array.prototype.slice.call(document.querySelectorAll('.map-model__pin'));
  var canvas = document.getElementById('map-canvas');
  var zoomValue = document.getElementById('map-zoom-value');
  var zoom = 1;

  function select(pin) {
    pins.forEach(function (item) {
      item.setAttribute('aria-current', item === pin ? 'true' : 'false');
    });
    document.getElementById('selected-icon').textContent = pin.getAttribute('data-icon');
    document.getElementById('selected-title').textContent = pin.getAttribute('data-title');
    document.getElementById('selected-copy').textContent = pin.getAttribute('data-copy');
    var facts = pin.getAttribute('data-facts').split('|');
    document.getElementById('selected-facts').innerHTML = '<li><span>' + facts[0] + '</span><strong>' + facts[1] + '</strong></li>';
    document.getElementById('mobile-icon').textContent = pin.getAttribute('data-icon');
    document.getElementById('mobile-title').textContent = pin.getAttribute('data-title');
    document.getElementById('mobile-copy').textContent = pin.getAttribute('data-copy');
    document.getElementById('mobile-long-copy').textContent = pin.getAttribute('data-copy');
  }

  pins.forEach(function (pin) { pin.addEventListener('click', function () { select(pin); }); });

  document.querySelectorAll('.map-model__filter').forEach(function (button) {
    button.addEventListener('click', function () {
      document.querySelectorAll('.map-model__filter').forEach(function (item) {
        item.setAttribute('aria-pressed', item === button ? 'true' : 'false');
      });
      pins.forEach(function (pin) {
        pin.hidden = button.getAttribute('data-filter') !== 'all' && pin.getAttribute('data-kind') !== button.getAttribute('data-filter');
      });
      var selected = document.querySelector('.map-model__pin[aria-current="true"]');
      if (selected && selected.hidden) {
        var next = pins.find(function (pin) { return !pin.hidden; });
        if (next) select(next);
      }
    });
  });

  document.querySelectorAll('[data-zoom]').forEach(function (button) {
    button.addEventListener('click', function () {
      zoom = Math.max(.9, Math.min(1.35, zoom + (button.getAttribute('data-zoom') === 'in' ? .15 : -.15)));
      canvas.style.transform = 'scale(' + zoom + ')';
      zoomValue.textContent = Math.round(zoom * 100) + '%';
    });
  });

  document.getElementById('mobile-more').addEventListener('click', function (event) {
    var expanded = document.querySelector('.map-model__mobile-info').classList.toggle('is-open');
    event.currentTarget.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    event.currentTarget.textContent = expanded ? 'Свернуть' : 'Подробнее';
  });

  document.addEventListener('click', function (event) {
    if (event.target.closest && event.target.closest('.switch__leto')) {
      window.location.href = '/karta/karta-fanparka.html';
    }
  });
}());
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
