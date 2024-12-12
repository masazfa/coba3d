<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://cesium.com/downloads/cesiumjs/releases/1.113/Build/Cesium/Cesium.js"></script>
  <link href="https://cesium.com/downloads/cesiumjs/releases/1.113/Build/Cesium/Widgets/widgets.css" rel="stylesheet">
</head>
<body>
  <style>
    body {
  overflow: hidden;
  margin: 0px;
  padding: 0px;
  height: 100vh;
}

#cesiumContainer {
  height: 100vh;
}
  </style>
  <div id="searchContainer" style="position: absolute; top: 10px; left: 10px; z-index: 1;">
    <input type="text" id="searchInput" placeholder="Search 3D data..." style="width: 200px; padding: 5px;">
    <div id="searchResults" style="max-height: 200px; overflow-y: auto; background: white; border: 1px solid #ccc; display: none;">
        <ul id="resultsList" style="list-style: none; padding: 0; margin: 0;"></ul>
    </div>
</div>

  <div id="cesiumContainer"></div>
  <script type="module">
    Cesium.Ion.defaultAccessToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJlZWY2NDhjNS00M2Y2LTQyOWItODRiMC02YzY0NmJiMGU4MWMiLCJpZCI6MTkwMjA3LCJpYXQiOjE3MDU0NzU1Nzh9.GC7NlIZjtNQXYctz51Kc71oWXspD4Gc4FQFyCM1TPYw';
    
    const viewer = new Cesium.Viewer('cesiumContainer', {
      terrain: Cesium.Terrain.fromWorldTerrain(),
      infoBox: true,
      selectionIndicator: true,
      shouldAnimate: true,
      shadows: true,
    });

    viewer.scene.setTerrain(
  new Cesium.Terrain(Cesium.CesiumTerrainProvider.fromIonAssetId(2918769))
);
   viewer.camera.flyTo({
      destination: Cesium.Cartesian3.fromDegrees(110.372414,-7.765453, 1000)
    });

    <?php foreach ($data3d as $key => $value): ?>
    const <?= $value['const'] ?> = viewer.scene.primitives.add(
        await Cesium.Cesium3DTileset.fromIonAssetId(<?= $value['assetid'] ?>)
    );
<?php endforeach; ?>

    viewer.screenSpaceEventHandler.setInputAction(function onLeftClick(movement) {
  var pickedFeature = viewer.scene.pick(movement.position);
  if (Cesium.defined(pickedFeature)) {
    if (pickedFeature.primitive === a) {
      viewer.selectedEntity = new Cesium.Entity({
        name: 'Teknik Geodesi dan Geomatika',
        description: '\
          <table>\
            <tr>\
              <td style="width: 100px;"><b>Deskripsi</b></td>\
              <td>:</td>\
              <td>Deskripsi Teknik Geodesi dan Geomatika</td>\
            </tr>\
            <tr>\
            <td style="width: 100px;"><b>Kondisi Aset</b></td>\
            <td>:</td>\
            <td>Baik</td>\
            </tr>\
          </table>'
      });
    }
    <?php foreach ($data3d as $key => $value): ?>
    else if (pickedFeature.primitive === <?= $value['const'] ?>) {
      viewer.selectedEntity = new Cesium.Entity({
        name: '<?= $value['nama'] ?>',
        description: '\
          <table>\
            <tr>\
              <td style="width: 100px;"><b>Deskripsi</b></td>\
              <td>:</td>\
              <td><?= $value['deskripsi'] ?></td>\
            </tr>\
            <tr>\
            <td style="width: 100px;"><b>Kondisi Aset</b></td>\
            <td>:</td>\
            <td><?= $value['kondisi'] ?></td>\
            </tr>\
          </table>'
      });
    }
    <?php endforeach; ?>
  }
}, Cesium.ScreenSpaceEventType.LEFT_CLICK);


// Function to handle search
function handleSearch() {
        const searchQuery = document.getElementById('searchInput').value.toLowerCase();
        let found = false;

        <?php foreach ($data3d as $key => $value): ?>
        if ('<?= strtolower($value['nama']) ?>'.includes(searchQuery)) {
            viewer.flyTo(<?= $value['const'] ?>);
            viewer.selectedEntity = new Cesium.Entity({
                name: '<?= $value['nama'] ?>',
                description: '\
                    <table>\
                        <tr>\
                            <td style="width: 100px;"><b>Deskripsi</b></td>\
                            <td>:</td>\
                            <td><?= $value['deskripsi'] ?></td>\
                        </tr>\
                        <tr>\
                            <td style="width: 100px;"><b>Kondisi Aset</b></td>\
                            <td>:</td>\
                            <td><?= $value['kondisi'] ?></td>\
                        </tr>\
                    </table>'
            });
            found = true;
        }
        <?php endforeach; ?>

        if (!found) {
            alert('No matching 3D data found.');
        }
    }

    // Add event listener to the search input
    document.getElementById('searchInput').addEventListener('input', handleSearch);
    
    </script>
</body>
</html>