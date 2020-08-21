<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Wavy Text</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

  <svg viewBox="0 0 1200 500">
    <defs>
      <clipPath id="clipPath">
        <text x="600" y="250" text-anchor="middle">anime</text>
      </clipPath>
    </defs>
    <g clip-path="url(#clipPath)">
        <path id="path" fill="#0099ff" fill-opacity="1"/>
    </g>
  </svg>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.0/anime.min.js"></script>

  <script>

    function random(min, max) {
        return Math.random() * (max - min) + min;
    }

    function createWave(h) {
        let width = 1200;
        let height = 500;

        let string = `M0, ${height * (1 - h)}`;
        // Number of cubic spines
        let splines = 2;
        for (let i = 0; i < splines; i++) {
            // Final x position of spline i
            let x = width * (i + 1) / splines;
            let y = height * (1 - h);
            // Starting position of spline i
            let start = width * i / splines;
            // Midpoint of spline i as control point
            let x2 = (start + x) / 2;
            let y2 = random(height * 0.2, height * 0.8);
            string += `S${x2},${y2},${x},${y}`;
        }
        string += `V${height}`;
        string += 'H0Z';

        return string;
    }

    const svgns = "http://www.w3.org/2000/svg";
    const path = document.getElementById("path");
    path.setAttributeNS(null, 'd', createWave(0));

    anime({
        targets: "svg path",
        duration: 5000,
        easing: 'linear',
        d: Array.from(Array(20), (e, i) => { return { value: createWave(i / 20) } }),
        direction: 'alternate',
        loop: true
    })

  </script>

</body>
</html>
