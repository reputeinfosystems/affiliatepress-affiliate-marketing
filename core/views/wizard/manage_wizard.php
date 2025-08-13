<?php
    if ( ! defined( 'ABSPATH' ) ) { exit; }
	global $affiliatepress_ajaxurl;
?>
<el-main class="ap-fullscreen-wizard-setup">
	<div class="ap-fws__header">
		<div class="ap-fws__head-logo">
			<a href="<?php echo esc_url( admin_url() . 'admin.php?page=affiliatepress_lite_wizard' ); ?>">
			<svg width="185" height="55" viewBox="0 0 185 55" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M67.8117 11.4748L61.9634 25.2372C61.8391 25.5786 61.6382 25.8512 61.3685 26.0497C61.1147 26.2296 60.8371 26.3196 60.5304 26.3196C60.0439 26.3196 59.6817 26.1846 59.4464 25.912C59.2137 25.6421 59.0947 25.306 59.0947 24.909C59.0947 24.7475 59.1212 24.5729 59.1767 24.3929L65.916 8.19569C66.0614 7.83311 66.2782 7.55521 66.5664 7.35672C66.8731 7.15822 67.1983 7.07618 67.542 7.11323C67.8672 7.11323 68.1633 7.21116 68.4356 7.4123C68.7238 7.59227 68.9327 7.85693 69.0569 8.19834L75.7169 24.0753C75.8068 24.3082 75.8517 24.5252 75.8517 24.7264C75.8517 25.2133 75.6905 25.6024 75.3653 25.8909C75.0586 26.1793 74.7149 26.3249 74.3368 26.3249C74.0116 26.3249 73.7155 26.227 73.4432 26.0258C73.1893 25.8273 72.9937 25.5547 72.8483 25.2133L67.0291 11.6389L67.8143 11.4775H67.8117V11.4748ZM62.8041 21.9342L64.2926 18.8191H71.6004L72.1159 21.9342H62.8041ZM79.8493 26.1899C79.3443 26.1899 78.9292 26.0364 78.604 25.7294C78.2974 25.4039 78.144 25.0069 78.144 24.5385V8.87322C78.144 8.40213 78.2974 8.01572 78.604 7.70872C78.9292 7.38319 79.3258 7.22174 79.7938 7.22174H88.5927C89.0633 7.22174 89.4493 7.37525 89.756 7.68225C90.0812 7.97073 90.2425 8.3492 90.2425 8.82029C90.2425 9.21728 90.0812 9.56928 89.756 9.87628C89.4493 10.1833 89.0633 10.3368 88.5927 10.3368H81.285L81.5282 10.0113V15.458L81.3378 15.106H87.3739C87.8445 15.106 88.2305 15.2595 88.5372 15.5665C88.8624 15.855 89.0236 16.2334 89.0236 16.7045C89.0236 17.1015 88.8624 17.4535 88.5372 17.7605C88.2305 18.0675 87.8445 18.221 87.3739 18.221H81.2823L81.5256 17.9775V24.5358C81.5256 25.0069 81.3537 25.4039 81.01 25.7268C80.6848 26.0338 80.2961 26.1873 79.8467 26.1873H79.8493V26.1899ZM95.0464 26.1899C94.5415 26.1899 94.1264 26.0364 93.8012 25.7294C93.4945 25.4039 93.3411 25.0069 93.3411 24.5385V8.87322C93.3411 8.40213 93.4945 8.01572 93.8012 7.70872C94.1264 7.38319 94.523 7.22174 94.9909 7.22174H103.79C104.26 7.22174 104.649 7.37525 104.953 7.68225C105.278 7.97073 105.44 8.3492 105.44 8.82029C105.44 9.21728 105.278 9.56928 104.953 9.87628C104.649 10.1833 104.26 10.3368 103.79 10.3368H96.4821L96.7253 10.0113V15.458L96.535 15.106H102.571C103.042 15.106 103.43 15.2595 103.734 15.5665C104.059 15.855 104.221 16.2334 104.221 16.7045C104.221 17.1015 104.059 17.4535 103.734 17.7605C103.43 18.0675 103.042 18.221 102.571 18.221H96.4794L96.7227 17.9775V24.5358C96.7227 25.0069 96.5508 25.4039 96.2071 25.7268C95.8819 26.0338 95.4933 26.1873 95.0438 26.1873H95.0464V26.1899ZM111.925 24.5358C111.925 25.0069 111.753 25.4039 111.41 25.7268C111.068 26.0338 110.669 26.1873 110.22 26.1873C109.715 26.1873 109.31 26.0338 109.001 25.7268C108.694 25.4012 108.541 25.0043 108.541 24.5358V8.87322C108.541 8.40213 108.702 8.01572 109.027 7.70872C109.353 7.38319 109.768 7.22174 110.273 7.22174C110.706 7.22174 111.084 7.38319 111.41 7.70872C111.751 8.01572 111.925 8.40213 111.925 8.87322V24.5332V24.5358ZM126.443 23.0193C126.913 23.0193 127.302 23.1728 127.606 23.4798C127.931 23.7683 128.093 24.1468 128.093 24.6179C128.093 25.0889 127.931 25.4489 127.606 25.7559C127.302 26.0444 126.913 26.1899 126.443 26.1899H117.644C117.176 26.1899 116.777 26.0364 116.454 25.7294C116.15 25.4039 115.994 25.0069 115.994 24.5385V8.87322C115.994 8.40213 116.155 8.01572 116.481 7.70872C116.806 7.38319 117.221 7.22174 117.726 7.22174C118.159 7.22174 118.537 7.38319 118.863 7.70872C119.204 8.01572 119.378 8.40213 119.378 8.87322V23.4772L118.783 23.0167H126.445H126.44L126.443 23.0193ZM134.578 24.5358C134.578 25.0069 134.406 25.4039 134.062 25.7268C133.721 26.0338 133.322 26.1873 132.87 26.1873C132.365 26.1873 131.961 26.0338 131.651 25.7268C131.345 25.4012 131.191 25.0043 131.191 24.5358V8.87322C131.191 8.40213 131.352 8.01572 131.678 7.70872C132.003 7.38319 132.418 7.22174 132.923 7.22174C133.357 7.22174 133.735 7.38319 134.06 7.70872C134.401 8.01572 134.575 8.40213 134.575 8.87322V24.5332H134.578V24.5358ZM145.603 11.4748L139.755 25.2372C139.63 25.5786 139.43 25.8512 139.16 26.0497C138.906 26.2296 138.628 26.3196 138.322 26.3196C137.835 26.3196 137.476 26.1846 137.238 25.912C137.005 25.6421 136.886 25.306 136.886 24.909C136.886 24.7475 136.913 24.5729 136.968 24.3929L143.707 8.1904C143.85 7.82781 144.07 7.54992 144.358 7.35143C144.664 7.15293 144.99 7.07089 145.333 7.10794C145.659 7.10794 145.955 7.20586 146.227 7.40701C146.515 7.58697 146.724 7.85163 146.848 8.19305L153.508 24.07C153.598 24.3029 153.643 24.5199 153.643 24.7211C153.643 25.208 153.482 25.5971 153.157 25.8856C152.853 26.1741 152.506 26.3196 152.128 26.3196C151.803 26.3196 151.507 26.2217 151.235 26.0205C150.983 25.8221 150.785 25.5495 150.64 25.208L144.82 11.6336L145.606 11.4722H145.6L145.603 11.4748ZM140.596 21.9342L142.084 18.8191H149.389L149.905 21.9342H140.596ZM161.001 26.1899C160.496 26.1899 160.081 26.0364 159.756 25.7294C159.431 25.4039 159.269 25.0069 159.269 24.5385V8.82294H162.788V24.5358C162.788 25.0069 162.617 25.4039 162.273 25.7268C161.948 26.0338 161.525 26.1873 161.001 26.1873V26.1899ZM155.018 10.3368C154.547 10.3368 154.151 10.1912 153.826 9.90275C153.519 9.61427 153.366 9.23581 153.366 8.76471C153.366 8.29362 153.519 7.92574 153.826 7.65314C154.151 7.36466 154.547 7.2191 155.018 7.2191H167.037C167.508 7.2191 167.894 7.36466 168.2 7.65314C168.526 7.94162 168.687 8.32008 168.687 8.79118C168.687 9.26227 168.526 9.64074 168.2 9.92922C167.894 10.1992 167.508 10.3368 167.037 10.3368H155.018ZM173.179 7.2191H182.247C182.718 7.2191 183.104 7.3726 183.411 7.6796C183.736 7.96808 183.897 8.34655 183.897 8.81764C183.897 9.28874 183.736 9.64074 183.411 9.92922C183.104 10.1992 182.718 10.3368 182.247 10.3368H174.667L174.911 9.87628V15.1615L174.694 14.9445H181.029C181.499 14.9445 181.888 15.098 182.192 15.405C182.517 15.6935 182.678 16.072 182.678 16.5431C182.678 17.0142 182.517 17.3662 182.192 17.6546C181.888 17.9246 181.499 18.0622 181.029 18.0622H174.776L174.911 17.8452V23.3184L174.694 23.0749H182.247C182.718 23.0749 183.104 23.2363 183.411 23.5619C183.736 23.8689 183.897 24.2288 183.897 24.647C183.897 25.0969 183.736 25.4701 183.411 25.7585C183.104 26.047 182.718 26.1926 182.247 26.1926H173.179C172.711 26.1926 172.312 26.0391 171.987 25.7321C171.68 25.4065 171.526 25.0095 171.526 24.5411V8.87322C171.526 8.40213 171.68 8.01572 171.987 7.70872C172.312 7.38319 172.708 7.22174 173.179 7.22174V7.2191Z" fill="black"/>
				<path d="M66.9681 32.51C67.8089 32.51 68.5544 32.7032 69.2022 33.0976C69.85 33.4734 70.3576 34.0027 70.7357 34.6802C71.1111 35.3578 71.3015 36.1332 71.3015 37.0066C71.3015 37.88 71.1137 38.6713 70.7357 39.3779C70.3602 40.0714 69.8473 40.6219 69.2022 41.0268C68.5544 41.4344 67.8115 41.6355 66.9681 41.6355H62.1879L62.299 41.4079V47.6406C62.299 47.8206 62.2302 47.9794 62.0954 48.1144C61.9606 48.2494 61.8019 48.3182 61.6221 48.3182C61.4106 48.3182 61.2467 48.2494 61.1251 48.1144C61.0035 47.9794 60.9453 47.8206 60.9453 47.6406V33.1902C60.9453 33.0102 61.0141 32.8514 61.1489 32.7165C61.2837 32.5815 61.4424 32.5127 61.6221 32.5127H66.9681V32.51ZM66.9681 40.3201C67.5551 40.3201 68.0653 40.1799 68.5016 39.8914C68.9378 39.5897 69.2762 39.19 69.5168 38.6951C69.7733 38.1817 69.9002 37.6206 69.9002 37.0013C69.9002 36.382 69.7733 35.8447 69.5168 35.3763C69.2762 34.8973 68.9378 34.5188 68.5016 34.2488C68.0653 33.9789 67.5551 33.8413 66.9681 33.8413H62.1879L62.299 33.6375V40.4551L62.1641 40.3201H66.9681ZM90.0361 48.3155C89.8087 48.3155 89.621 48.2467 89.4703 48.1117C89.3355 47.9768 89.2667 47.818 89.2667 47.638V33.1875C89.2667 33.0076 89.3355 32.8488 89.4703 32.7138C89.6052 32.5788 89.7638 32.51 89.9436 32.51H96.0351C96.8917 32.51 97.6585 32.6979 98.3353 33.0764C99.0121 33.439 99.5383 33.9418 99.9164 34.5902C100.308 35.2387 100.503 35.9691 100.503 36.7816C100.503 37.4433 100.382 38.0546 100.141 38.6104C99.9005 39.1662 99.5621 39.6426 99.1258 40.0343C98.6896 40.4101 98.2031 40.688 97.6611 40.8706L96.8732 40.6218C97.4285 40.6668 97.9467 40.8495 98.4305 41.1644C98.9143 41.4661 99.295 41.8869 99.5806 42.4268C99.882 42.9535 100.041 43.594 100.054 44.3483C100.07 44.9967 100.099 45.4995 100.141 45.8621C100.202 46.2247 100.287 46.4947 100.392 46.6746C100.498 46.8546 100.633 46.9975 100.799 47.1034C100.95 47.1934 101.048 47.3204 101.09 47.4871C101.148 47.6512 101.135 47.81 101.045 47.9609C100.987 48.0826 100.895 48.1726 100.776 48.2308C100.67 48.2758 100.559 48.2996 100.437 48.2996C100.316 48.2996 100.197 48.2705 100.075 48.2097C99.8635 48.0879 99.6467 47.9 99.422 47.6433C99.2104 47.3866 99.0307 47.0107 98.88 46.5158C98.7451 46.0183 98.6764 45.3249 98.6764 44.4382C98.6764 43.8507 98.5785 43.369 98.3829 42.9932C98.2031 42.6174 97.9625 42.3316 97.6611 42.1357C97.3756 41.924 97.053 41.7811 96.6908 41.707C96.3471 41.617 96.014 41.572 95.6993 41.572H90.4433L90.6918 41.257V47.6459C90.6918 47.8259 90.6336 47.9847 90.512 48.1197C90.3904 48.2546 90.2318 48.3235 90.0388 48.3235H90.0361V48.3155ZM90.4406 40.3201H96.1012C96.6141 40.2751 97.0927 40.1084 97.5448 39.8226C97.9943 39.5209 98.3565 39.1159 98.6288 38.6025C98.9143 38.0891 99.0571 37.4962 99.0571 36.8187C99.0571 35.9612 98.7636 35.2545 98.1767 34.6988C97.6056 34.1271 96.8521 33.8413 95.9188 33.8413H90.5279L90.6865 33.5263V40.6404L90.438 40.3254H90.4433L90.4406 40.3201ZM119.944 32.51H128.222C128.402 32.51 128.56 32.5788 128.695 32.7138C128.83 32.8355 128.899 32.9943 128.899 33.1875C128.899 33.3807 128.83 33.5422 128.695 33.6613C128.56 33.783 128.404 33.8413 128.222 33.8413H120.462L120.689 33.4575V39.8014L120.438 39.5076H127.207C127.386 39.5076 127.545 39.5764 127.68 39.7114C127.815 39.8464 127.884 40.0052 127.884 40.1852C127.884 40.3784 127.815 40.5398 127.68 40.6589C127.545 40.7806 127.389 40.8389 127.207 40.8389H120.486L120.689 40.6113V47.114L120.578 46.979H128.225C128.404 46.979 128.563 47.0478 128.698 47.1828C128.833 47.3177 128.901 47.4765 128.901 47.6565C128.901 47.8497 128.833 48.0112 128.698 48.1303C128.563 48.252 128.407 48.3102 128.225 48.3102H119.947C119.767 48.3102 119.608 48.2414 119.473 48.1064C119.338 47.9715 119.27 47.8127 119.27 47.6327V33.1823C119.27 33.0023 119.338 32.8435 119.473 32.7085C119.608 32.5735 119.764 32.5047 119.947 32.5047L119.944 32.51ZM151.324 48.5405C150.182 48.5564 149.188 48.3764 148.347 47.9979C147.507 47.6221 146.7 47.0584 145.933 46.3041C145.859 46.2459 145.793 46.1691 145.73 46.0765C145.685 45.9865 145.661 45.8833 145.661 45.7615C145.661 45.5816 145.73 45.4175 145.865 45.264C146.015 45.1131 146.182 45.0364 146.362 45.0364C146.541 45.0364 146.705 45.1131 146.859 45.264C147.446 45.8965 148.107 46.3782 148.844 46.709C149.595 47.0399 150.402 47.2066 151.258 47.2066C151.98 47.2066 152.62 47.0954 153.178 46.8678C153.749 46.6402 154.201 46.3173 154.531 45.8965C154.862 45.4757 155.028 44.9861 155.028 44.4303C155.028 43.7395 154.841 43.1811 154.463 42.7603C154.087 42.3236 153.593 41.9716 152.974 41.699C152.358 41.4132 151.673 41.1565 150.92 40.9315C150.301 40.7515 149.717 40.5477 149.159 40.3228C148.604 40.0819 148.107 39.7961 147.67 39.4653C147.234 39.1212 146.896 38.7004 146.655 38.2029C146.415 37.7053 146.293 37.1045 146.293 36.3979C146.293 35.5986 146.504 34.892 146.925 34.2779C147.345 33.6586 147.94 33.1796 148.707 32.8329C149.489 32.4703 150.391 32.2903 151.414 32.2903C152.3 32.2903 153.151 32.4412 153.963 32.7403C154.79 33.042 155.446 33.4866 155.925 34.0715C156.149 34.3124 156.263 34.532 156.263 34.7252C156.263 34.8761 156.186 35.0269 156.036 35.1751C155.885 35.326 155.721 35.4028 155.539 35.4028C155.388 35.4028 155.258 35.3498 155.155 35.244C154.899 34.929 154.576 34.6485 154.185 34.4076C153.794 34.1509 153.357 33.9577 152.876 33.8201C152.411 33.6851 151.919 33.6163 151.412 33.6163C150.706 33.6163 150.066 33.7275 149.492 33.9551C148.937 34.1668 148.493 34.4738 148.162 34.8787C147.845 35.2863 147.689 35.7733 147.689 36.3449C147.689 36.9775 147.869 37.4962 148.231 37.9038C148.593 38.3114 149.064 38.6501 149.653 38.9201C150.24 39.1768 150.864 39.4176 151.525 39.6426C152.173 39.8226 152.786 40.0343 153.373 40.2751C153.976 40.5028 154.5 40.7886 154.954 41.1326C155.42 41.4767 155.782 41.916 156.038 42.4427C156.308 42.9694 156.446 43.6337 156.446 44.4303C156.446 45.2269 156.229 45.8912 155.792 46.5079C155.356 47.1272 154.753 47.6142 153.989 47.9741C153.236 48.3367 152.35 48.5246 151.33 48.5405H151.324ZM178.879 48.5405C177.737 48.5564 176.743 48.3764 175.902 47.9979C175.061 47.6221 174.255 47.0584 173.488 46.3041C173.414 46.2459 173.348 46.1691 173.285 46.0765C173.24 45.9865 173.216 45.8833 173.216 45.7615C173.216 45.5816 173.285 45.4175 173.419 45.264C173.57 45.1131 173.737 45.0364 173.916 45.0364C174.096 45.0364 174.26 45.1131 174.413 45.264C175 45.8965 175.661 46.3782 176.399 46.709C177.15 47.0399 177.956 47.2066 178.813 47.2066C179.535 47.2066 180.175 47.0954 180.732 46.8678C181.303 46.6402 181.756 46.3173 182.086 45.8965C182.417 45.4757 182.583 44.9861 182.583 44.4303C182.583 43.7395 182.395 43.1811 182.017 42.7603C181.642 42.3236 181.147 41.9716 180.529 41.699C179.913 41.4132 179.228 41.1565 178.474 40.9315C177.856 40.7515 177.272 40.5477 176.714 40.3228C176.158 40.0819 175.661 39.7961 175.225 39.4653C174.789 39.1212 174.45 38.7004 174.21 38.2029C173.969 37.7053 173.848 37.1045 173.848 36.3979C173.848 35.5986 174.059 34.892 174.48 34.2779C174.9 33.6586 175.495 33.1796 176.262 32.8329C177.044 32.4703 177.946 32.2903 178.969 32.2903C179.855 32.2903 180.706 32.4412 181.518 32.7403C182.345 33.042 183.001 33.4866 183.479 34.0715C183.704 34.3124 183.818 34.532 183.818 34.7252C183.818 34.8761 183.741 35.0269 183.59 35.1751C183.44 35.326 183.276 35.4028 183.093 35.4028C182.943 35.4028 182.813 35.3498 182.71 35.244C182.454 34.929 182.131 34.6485 181.74 34.4076C181.348 34.1509 180.912 33.9577 180.431 33.8201C179.966 33.6851 179.474 33.6163 178.966 33.6163C178.26 33.6163 177.621 33.7275 177.047 33.9551C176.492 34.1668 176.047 34.4738 175.717 34.8787C175.4 35.2863 175.244 35.7733 175.244 36.3449C175.244 36.9775 175.423 37.4962 175.786 37.9038C176.148 38.3114 176.618 38.6501 177.208 38.9201C177.795 39.1768 178.419 39.4176 179.08 39.6426C179.728 39.8226 180.341 40.0343 180.928 40.2751C181.531 40.5028 182.054 40.7886 182.509 41.1326C182.974 41.4767 183.337 41.916 183.593 42.4427C183.863 42.9694 184 43.6337 184 44.4303C184 45.2269 183.783 45.8912 183.347 46.5079C182.911 47.1272 182.308 47.6142 181.544 47.9741C180.791 48.3367 179.905 48.5246 178.884 48.5405H178.879Z" fill="black"/>
				<path d="M18.8355 25.5415L18.8514 25.5256C19.2004 25.1816 19.5731 24.856 19.9909 24.5993C26.4843 20.6215 33.332 30.2869 26.8809 34.9819C21.5852 38.838 15.1155 32.9494 17.4369 27.5371C17.7621 26.7828 18.2565 26.1158 18.8355 25.5389V25.5415Z" fill="#1CC6C9"/>
				<path d="M20.3032 22.5509L20.3111 22.5429C20.5411 22.3127 20.795 22.1009 21.0699 21.9289C25.39 19.2823 29.9375 25.7083 25.6518 28.8339C22.1328 31.3984 17.8285 27.4815 19.3699 23.8821C19.584 23.3819 19.9172 22.9373 20.3032 22.5535V22.5482V22.5509Z" fill="#6858E0"/>
				<path d="M44.2092 2.26466C39.7199 0.973119 35.1671 4.57514 35.175 9.18552C35.175 9.61956 35.2358 10.0351 35.2966 10.4559C35.3812 11.0434 35.4685 11.6442 35.4024 12.327C34.9714 16.7998 31.4154 15.5638 28.3485 14.4999C27.4284 14.1797 26.5506 13.8753 25.8156 13.7456C22.6324 13.1819 19.6025 13.6795 16.6783 14.9789C16.3505 15.1245 16.0041 15.3362 15.6525 15.5506C14.4812 16.2652 13.2201 17.038 12.1414 15.6856C11.417 14.7725 11.5359 13.7139 11.6576 12.6261C11.7237 12.0386 11.7898 11.4431 11.7263 10.8608C11.4778 8.6165 9.46841 6.45952 7.20523 6.1684C0.190972 5.26326 -1.8369 15.7967 6.19526 17.0221C6.47552 17.0645 6.76106 17.0512 7.0466 17.0353C7.31892 17.0221 7.5886 17.0089 7.84506 17.0459C11.7078 17.57 10.8009 19.4676 9.77775 21.6087C9.516 22.1539 9.24897 22.7149 9.05067 23.2734C6.7637 29.6993 8.5404 36.861 14.1719 40.8918C14.4125 41.0638 14.7879 41.2809 15.2083 41.519C16.295 42.141 17.6724 42.927 17.7729 43.5993C17.8601 44.1895 16.948 44.8352 16.1178 45.4254C15.6366 45.7668 15.1819 46.0897 14.9651 46.3703C13.6722 48.0297 13.7251 50.5757 15.3749 51.9387L15.3696 51.9334C18.6612 54.6568 22.8465 51.7455 21.9476 47.7756C21.8815 47.4792 21.6277 47.0663 21.3527 46.619C20.8107 45.7351 20.1868 44.7135 20.7288 44.1683C21.1042 43.7898 22.4473 43.8189 23.5525 43.8428C24.0495 43.8533 24.5016 43.8639 24.7924 43.8348C33.7209 42.9429 39.7569 34.3123 38.0727 25.5759C37.9326 24.8455 37.5651 23.9668 37.1765 23.0378C36.2722 20.8676 35.257 18.4354 36.7614 17.0433C38.0516 15.8523 39.3471 15.9661 40.7166 16.0852C41.2031 16.1276 41.7002 16.1725 42.2078 16.1567C50.5625 15.937 51.9241 4.48251 44.2066 2.26201L44.2092 2.26466ZM32.9885 32.121C29.2368 43.3134 11.9378 40.3889 12.9769 27.4047C13.3021 23.3501 17.2679 19.1103 21.3157 18.5624C29.2263 17.4906 35.5822 24.4008 32.9912 32.121H32.9885Z" fill="#6858E0"/>
				</svg>

			</a>
		</div>
	</div>

    <div class="ap-fws__body">
		<el-tabs type="card" class="ap-fws-tab-wrapper" v-model="affiliatepress_active_tab">
            <el-tab-pane class="ap-fws-tab-pane-item" name="basic_settings" :disabled="affiliatepress_disabled_tabs">
				<template #label>
					<div class="ap-head-counter-line"></div>
					<div class="ap-tpi__tab-menu-item">    
						<span class="ap-tpi__counter">01</span>
						<div class="ap-tpi__item-link"><?php esc_html_e('Basic Settings', 'affiliatepress-affiliate-marketing'); ?></div>
					</div>
            	</template>
				<div class="ap-fws-tab-pane-body">
					<div class="ap-tpb__head">
						<div class="ap-main-head"><?php esc_html_e('Basic Settings', 'affiliatepress-affiliate-marketing'); ?></div>
						<div class="ap-head-content"><?php esc_html_e('Configure these key options for your affiliate program. You can adjust them later if needed.', 'affiliatepress-affiliate-marketing'); ?></div>
					</div>
					<div class="ap-tpb__form-body ap-basic_setting-wrapper">
						<el-row class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Company Name',  'affiliatepress-affiliate-marketing'); ?></span></label>                                     
									<el-form-item prop="company_name">
										<el-input class="ap-form-control" type="text" v-model="wizard_steps_data.company_name" size="large" placeholder="<?php esc_html_e('Enter Company name',  'affiliatepress-affiliate-marketing'); ?>" />     
									</el-form-item>
								</div>
							</el-col>
						</el-row>
						<el-row class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('From Email',  'affiliatepress-affiliate-marketing'); ?></span></label>                                     
									<el-form-item prop="sender_email">
										<el-input class="ap-form-control" type="text" v-model="wizard_steps_data.sender_email" size="large" placeholder="<?php esc_html_e('Enter sender email',  'affiliatepress-affiliate-marketing'); ?>" />     
									</el-form-item>
								</div>
							</el-col>
						</el-row>
						<el-row class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Admin email',  'affiliatepress-affiliate-marketing'); ?></span></label>                                     
									<el-form-item prop="admin_email">
										<el-input class="ap-form-control" type="text" v-model="wizard_steps_data.admin_email" size="large" placeholder="<?php esc_html_e('Enter Admin email',  'affiliatepress-affiliate-marketing'); ?>" />     
									</el-form-item>
								</div>
							</el-col>
						</el-row>
						<el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
                            <el-col :xs="20" :sm="20" :md="20" :lg="14" :xl="14" class="ap-gs__cb-item-left">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Allow Affiliate Signup',  'affiliatepress-affiliate-marketing'); ?></span></label>  
								</div>
                            </el-col>
                            <el-col :xs="4" :sm="4" :md="4" :lg="10" :xl="10" class="ap-gs__cb-item-right ap-wizard-right">				
                                <el-switch v-model="wizard_steps_data.allow_affiliate_registration" size="large"/>                                         
                            </el-col>
                        </el-row>
						<el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
                            <el-col :xs="20" :sm="20" :md="20" :lg="14" :xl="14" class="ap-gs__cb-item-left">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Auto Approve & Activate New User Registration',  'affiliatepress-affiliate-marketing'); ?></span></label>  
								</div>
                            </el-col>
                            <el-col :xs="4" :sm="4" :md="4" :lg="10" :xl="10" class="ap-gs__cb-item-right ap-wizard-right">				
                                <el-switch v-model="wizard_steps_data.affiliate_default_status" size="large"/>                                         
                            </el-col>
                        </el-row>
						<el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
                            <el-col :xs="20" :sm="20" :md="20" :lg="16" :xl="16" class="ap-gs__cb-item-left">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Help us Improve AffiliatePress by sending anonymous usage stats',  'affiliatepress-affiliate-marketing'); ?></span></label>  
								</div>
                            </el-col>
                            <el-col :xs="4" :sm="4" :md="4" :lg="8" :xl="8" class="ap-gs__cb-item-right ap-wizard-right">				
                                <el-switch v-model="wizard_steps_data.affiliate_usage_stats" size="large"/>                                         
                            </el-col>
                        </el-row>
					</div>
					<div class="ap-tpb__foot-action-btns">
						<div class="ap-fab--wrapper">
							<el-button class="el-button el-button--primary ap-btn--primary ap-btn--big" @click="affiliatepress_next_tab('basic_settings')">
								<?php esc_html_e( 'Next', 'affiliatepress-affiliate-marketing'); ?>
								<span class="material-icons-round ap-next-btn-arrow">east</span>
							</el-button>
						</div>
					</div>
				</div>
			</el-tab-pane>

			<el-tab-pane class="ap-fws-tab-pane-item" name="commission_setting" :disabled="affiliatepress_disabled_tabs">
				<template #label>
					<div class="ap-head-counter-line"></div>
					<div class="ap-tpi__tab-menu-item">    
						<span class="ap-tpi__counter">02</span>
						<div class="ap-tpi__item-link"><?php esc_html_e('Commission Settings', 'affiliatepress-affiliate-marketing'); ?></div>
					</div>
            	</template>
				<div class="ap-fws-tab-pane-body">
					<div class="ap-tpb__head">
						<div class="ap-main-head"><?php esc_html_e('Commission Settings', 'affiliatepress-affiliate-marketing'); ?></div>
						<div class="ap-head-content"><?php esc_html_e('Configure these key options for your affiliate program. You can adjust them later if needed.', 'affiliatepress-affiliate-marketing'); ?></div>
					</div>
					<div class="ap-tpb__form-body ap-commission-setting-wrapper">
						<el-row class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
								<div class="ap-combine-field">
								<label><span class="ap-form-label"><?php esc_html_e('Commission Rate', 'affiliatepress-affiliate-marketing'); ?>           </span></label>      
									<el-row type="flex" :gutter="16">
										<el-col :xs="24" :sm="24" :md="24" :lg="20" :xl="20">
											<el-form-item prop="default_commission_rate">    
												<el-input class="ap-form-control" type="text" @input="isNumberValidate" v-model="wizard_steps_data.default_commission_rate" size="large" placeholder="<?php esc_html_e('Enter Commission Rate', 'affiliatepress-affiliate-marketing'); ?>" /> 
											</el-form-item>  
										</el-col>
										<el-col :xs="24" :sm="24" :md="24" :lg="4" :xl="4">
											<el-form-item prop="default_commission_rate">    
												<el-select class="ap-form-control" v-model="wizard_steps_data.default_discount_type" placeholder="Select" size="large">
													<el-option value="percentage" label="<?php esc_html_e( '%', 'affiliatepress-affiliate-marketing'); ?>"></el-option>
													<el-option value="fixed" label="<?php esc_html_e( 'Fixed Rate', 'affiliatepress-affiliate-marketing'); ?>"></el-option>                                                           
												</el-select>
											</el-form-item>  
										</el-col>
									</el-row>
								</div>
							</el-col>
						</el-row>
						<el-row :gutter="10" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Flat Rate Commission Basis', 'affiliatepress-affiliate-marketing'); ?>           </span></label>      
									<el-form-item prop="flat_rate_commission_basis">                       
										<el-select class="ap-form-control" v-model="wizard_steps_data.flat_rate_commission_basis" placeholder="Select" size="large">
											<el-option value="pre_product" label="<?php esc_html_e( 'Flat Rate Commission Per Product Sold', 'affiliatepress-affiliate-marketing'); ?>"><?php esc_html_e( 'Flat Rate Commission Per Product Sold', 'affiliatepress-affiliate-marketing'); ?></el-option>

											<el-option value="pre_order" label="<?php esc_html_e( 'Flat Rate Commission Per Order', 'affiliatepress-affiliate-marketing'); ?>"><?php esc_html_e( 'Flat Rate Commission Per Order', 'affiliatepress-affiliate-marketing'); ?></el-option>                                                            
										</el-select>   
									</el-form-item>
								</div>
							</el-col>
						</el-row>
						<el-row :gutter="10" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Choose Currency', 'affiliatepress-affiliate-marketing'); ?>           </span></label>    
									<el-form-item prop="payment_default_currency">                                 
										<el-select v-model="wizard_steps_data.payment_default_currency" placeholder="<?php esc_html_e('Select Currency', 'affiliatepress-affiliate-marketing'); ?>"class="ap-form-control" size="large">
											<el-option v-for="currency_data in currency_countries" :key="currency_data.name" :label="currency_data.name+' '+currency_data.symbol" :value="currency_data.code"/></el-option>         
										</el-select>
									</el-form-item>
								</div>
							</el-col>
						</el-row>
						<el-row :gutter="10" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Payment Minimum Amount', 'affiliatepress-affiliate-marketing'); ?>           </span></label>      
									<el-form-item prop="minimum_payment_amount">                                    
										<el-input type="text" v-model="wizard_steps_data.minimum_payment_amount" placeholder="<?php esc_html_e('Enter Minimum Payment Amount', 'affiliatepress-affiliate-marketing'); ?>"class ="ap-form-control"size="large"></el-input>
									</el-form-item>
								</div>
							</el-col>
						</el-row>
						<el-row :gutter="10" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Integration', 'affiliatepress-affiliate-marketing'); ?>           </span></label>   
									<el-form-item prop="minimum_payment_amount">                                     
										<el-select v-model="wizard_steps_data.integrations" placeholder="<?php esc_html_e('Select Integration', 'affiliatepress-affiliate-marketing'); ?>"class="ap-form-control"size="large">
											<el-option v-for="item in all_integration_list" :key="item.plugin_value" :label="item.plugin_name" :value="item.plugin_value"/>
										</el-select>
									</el-form-item>
								</div>
							</el-col>
						</el-row>
						<el-row :gutter="10" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Refund Grace Period', 'affiliatepress-affiliate-marketing'); ?>
									<el-tooltip popper-class="ap--setting-popover-tool-tip" raw-content content="<p><?php esc_html_e('The grace period (set in number of days) is used when generating payouts for your affiliates. It helps you filter out commissions that could still be rejected due to a refund of the underlying purchase. We recommend you to set this equal to your store refund policy.', 'affiliatepress-affiliate-marketing'); ?></p>" show-after="300" effect="light"  placement="bottom-start">
                                            <span class="ap-setting-info-icon">
                                                <?php do_action('affiliatepress_common_svg_code','info_icon'); ?>                                        
                                            </span>
                                    </el-tooltip>                  	
									</span></label>                                     
									<el-form-item prop="refund_grace_period">
                                        <el-input-number v-model="wizard_steps_data.refund_grace_period" class="ap-form-control--number" :min="0" :max="60" size="large" />                                     
                                    </el-form-item>          
								</div>
							</el-col>
						</el-row>
					</div>
					<div class="ap-tpb__foot-action-btns">
						<div class="ap-fab--wrapper">
							<el-button class="el-button ap-btn--big" @click="affiliatepress_previous_tab('commission_setting')">
								<span class="material-icons-round ap-prv-btn-arrow">west</span>
								<?php esc_html_e( 'Prev', 'affiliatepress-affiliate-marketing'); ?>
							</el-button>
							<el-button class="el-button el-button--primary ap-btn--primary ap-btn--big" @click="affiliatepress_next_tab('commission_setting')">
								<?php esc_html_e( 'Next', 'affiliatepress-affiliate-marketing'); ?>
								<span class="material-icons-round ap-next-btn-arrow">east</span>
							</el-button>
						</div>
					</div>
				</div>
			</el-tab-pane>

            <el-tab-pane class="ap-fws-tab-pane-item" name="email_notification" :disabled="affiliatepress_disabled_tabs">
				<template #label>
                    <div class="ap-head-counter-line"></div>
					<div class="ap-tpi__tab-menu-item">    
						<span class="ap-tpi__counter">03</span>
						<div class="ap-tpi__item-link"><?php esc_html_e('Email Notifications', 'affiliatepress-affiliate-marketing'); ?></div>
					</div>
            	</template>
				<div class="ap-fws-tab-pane-body">
					<div class="ap-tpb__head">
						<div class="ap-main-head"><?php esc_html_e('Email Notifications', 'affiliatepress-affiliate-marketing'); ?></div>
						<div class="ap-head-content"><?php esc_html_e('You can customize each email to suit your needs later in the AffiliatePress settings page.', 'affiliatepress-affiliate-marketing'); ?></div>
					</div>
					<div class="ap-tpb__form-body">
						<div class="ap-tpb__full-width-inline">
						 <div class="el-form-email-option">
							 <label class="ap-wizard-email-tab"><?php esc_html_e( 'Admin Notifications', 'affiliatepress-affiliate-marketing'); ?></label>	
						 </div>
						 <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-email-switch">
                            <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Account Pending', 'affiliatepress-affiliate-marketing'); ?>
								</div>
                            </el-col>
                            <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right ap-wizard-right">				
                                <el-switch v-model="wizard_steps_data.affiliate_notification.admin_account_pending" size="large"/>                                         
                            </el-col>
                        </el-row>
						 <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-email-switch">
                            <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Commission Registered', 'affiliatepress-affiliate-marketing'); ?>
								</div>
                            </el-col>
                            <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right ap-wizard-right">				
                                <el-switch v-model="wizard_steps_data.affiliate_notification.admin_commission_registerd" size="large"/>                                         
                            </el-col>
                        </el-row>
						 <div class="el-form-email-option el-form-affiliate-notification">
							 <label class="ap-wizard-email-tab"><?php esc_html_e( 'Affiliate Notifications', 'affiliatepress-affiliate-marketing'); ?></label>	
						 </div>
						 <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-email-switch">
                            <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Account Pending', 'affiliatepress-affiliate-marketing'); ?>
								</div>
                            </el-col>
                            <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right ap-wizard-right">				
                                <el-switch v-model="wizard_steps_data.affiliate_notification.affiliate_account_pending" size="large"/>                                         
                            </el-col>
                        </el-row>
						 <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-email-switch">
                            <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Commission Approved', 'affiliatepress-affiliate-marketing'); ?>
								</div>
                            </el-col>
                            <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right ap-wizard-right">				
                                <el-switch v-model="wizard_steps_data.affiliate_notification.affiliate_commission_approved" size="large"/>                                         
                            </el-col>
                        </el-row>
						 <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-email-switch">
                            <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Commission Paid', 'affiliatepress-affiliate-marketing'); ?>
								</div>
                            </el-col>
                            <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right ap-wizard-right">				
                                <el-switch v-model="wizard_steps_data.affiliate_notification.affiliate_payment_paid" size="large"/>                                         
                            </el-col>
                        </el-row>
					 </div>
					</div>
					<div class="ap-tpb__foot-action-btns">
						<div class="ap-fab--wrapper">
							<el-button class="el-button ap-btn--big" @click="affiliatepress_previous_tab('email_notification')">
								<span class="material-icons-round ap-prv-btn-arrow">west</span>
								<?php esc_html_e( 'Prev', 'affiliatepress-affiliate-marketing'); ?>
							</el-button>
							<el-button class="el-button el-button--primary ap-btn--primary ap-btn--big" @click="affiliatepress_next_tab('email_notification')">
								<?php esc_html_e( 'Next', 'affiliatepress-affiliate-marketing'); ?>
								<span class="material-icons-round ap-next-btn-arrow">east</span>
							</el-button>
						</div>
					</div>
				</div>
			</el-tab-pane>

			<el-tab-pane class="ap-fws-tab-pane-item" name="style_settings" :disabled="affiliatepress_disabled_tabs">
				<template #label>
					<div class="ap-head-counter-line"></div>
					<div class="ap-tpi__tab-menu-item">    
						<span class="ap-tpi__counter">04</span>
						<div class="ap-tpi__item-link"><?php esc_html_e('Styling', 'affiliatepress-affiliate-marketing'); ?></div>
					</div>
            	</template>
				<div class="ap-fws-tab-pane-body">
					<div class="ap-tpb__head">
						<div class="ap-main-head"><?php esc_html_e('Styling', 'affiliatepress-affiliate-marketing'); ?></div>
						<div class="ap-head-content"><?php esc_html_e('Almost there. Choose basic colors & fonts for Affiliate Panel.', 'affiliatepress-affiliate-marketing'); ?></div>
					</div>
					<div class="ap-tpb__form-body ap-style_setting-wrapper">
						<el-row :gutter="32" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Font Setting',  'affiliatepress-affiliate-marketing'); ?></span></label>                                     
									<el-form-item prop="font">
                                        <el-select filterable class="ap-form-control" v-model="wizard_steps_data.font" placeholder="Select" size="large">
                                            <el-option-group v-for="item_data in fonts_list" :key="item_data.label" :label="item_data.label">
                                                <el-option v-for="item in item_data.options" :key="item" :label="item" :value="item"></el-option>
                                            </el-option-group>                                                          
                                        <el-select>   
                                    </el-form-item>
								</div>
							</el-col>
						</el-row>
						<el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left ap-style-settings-head">
								<h4><?php esc_html_e('Color Settings', 'affiliatepress-affiliate-marketing'); ?></h4>
							</el-col>
						</el-row>
						<el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Primary Color', 'affiliatepress-affiliate-marketing'); ?>
								</div>
							</el-col>
							<el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right ap-wizard-right">				
								<div class="ap-gs_cb-item-setting-control-first">
                                    <el-color-picker size="large" class="ap-customize-tp__color-picker" v-model="wizard_steps_data.primary_color"></el-color-picker>
                                </div>                                         
							</el-col>
						</el-row>
						<el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Background Color', 'affiliatepress-affiliate-marketing'); ?>
								</div>
							</el-col>
							<el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right ap-wizard-right">				
								<div class="ap-gs_cb-item-setting-control-first">
									<el-color-picker size="large" class="ap-customize-tp__color-picker" v-model="wizard_steps_data.background_color"></el-color-picker>
                                </div>                                        
							</el-col>
						</el-row>
						<el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Panel Background Color', 'affiliatepress-affiliate-marketing'); ?>
								</div>
							</el-col>
							<el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right ap-wizard-right">				
								<div class="ap-gs_cb-item-setting-control-first">
									<el-color-picker size="large" class="ap-customize-tp__color-picker" v-model="wizard_steps_data.panel_background_color"></el-color-picker>
                                </div>                                        
							</el-col>
						</el-row>
						<el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Title Text Color', 'affiliatepress-affiliate-marketing'); ?>
								</div>
							</el-col>
							<el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right ap-wizard-right">				
								<div class="ap-gs_cb-item-setting-control-first">
									<el-color-picker size="large" class="ap-customize-tp__color-picker" v-model="wizard_steps_data.text_color"></el-color-picker>
                                </div>                                               
							</el-col>
						</el-row>
						<el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Content Color', 'affiliatepress-affiliate-marketing'); ?>
								</div>
							</el-col>
							<el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right ap-wizard-right">				
								<div class="ap-gs_cb-item-setting-control-first">
									<el-color-picker size="large" class="ap-customize-tp__color-picker" v-model="wizard_steps_data.content_color"></el-color-picker>
                                </div>                              
							</el-col>
						</el-row>
						<el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-wizard-row">
							<el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
								<div class="ap-combine-field">
									<label><span class="ap-form-label"><?php esc_html_e('Border Color', 'affiliatepress-affiliate-marketing'); ?>
								</div>
							</el-col>
							<el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right ap-wizard-right">				
								<div class="ap-gs_cb-item-setting-control-first">
									<el-color-picker size="large" class="ap-customize-tp__color-picker" v-model="wizard_steps_data.border_color"></el-color-picker>
                                </div>                              
							</el-col>
						</el-row>
					</div>
					<div class="ap-tpb__foot-action-btns">
						<div class="ap-fab--wrapper">
							<el-button class="el-button ap-btn--big" @click="affiliatepress_previous_tab('style_settings')">
								<span class="material-icons-round ap-prv-btn-arrow">west</span>
								<?php esc_html_e( 'Prev', 'affiliatepress-affiliate-marketing'); ?>
							</el-button>
							<el-button class="el-button el-button--primary ap-btn--primary ap-btn--big" @click="affiliatepress_next_tab('style_settings')">
								<?php esc_html_e( 'Finish', 'affiliatepress-affiliate-marketing'); ?>
							</el-button>
						</div>
					</div>
				</div>
			</el-tab-pane>

			<el-tab-pane class="ap-fws-tab-pane-item" name="finish_tab" :disabled="affiliatepress_disabled_tabs">
				<template #label>
					<div class="ap-tpi__tab-menu-item">    
						<span class="ap-tpi__counter">05</span>
						<div class="ap-tpi__item-link"><?php esc_html_e('Finish', 'affiliatepress-affiliate-marketing'); ?></div>
					</div>
            	</template>
				<div class="ap-fws-tab-pane-body">
					<div class="ap-tpb__head">
						<div class="ap-main-head"><?php esc_html_e('Congratulations!', 'affiliatepress-affiliate-marketing'); ?></div>
						<svg class="ap-wizard-complete-image" width="150" height="123" viewBox="0 0 150 123" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M115.595 48.0909C114.798 47.5029 114.176 46.7132 113.795 45.8048C113.414 44.8965 113.287 43.9032 113.429 42.9297C115.285 31.3825 113.164 27.8396 111.572 26.265C109.981 24.6904 106.444 22.6346 94.7738 24.4717C93.7905 24.6024 92.7897 24.4729 91.8734 24.0964C90.9571 23.7199 90.158 23.1099 89.5575 22.3285C81.8657 12.181 77.8429 11 75.5 11C73.1571 11 69.1343 12.181 61.4425 22.3285C60.842 23.1099 60.0429 23.7199 59.1266 24.0964C58.2103 24.4729 57.2095 24.6024 56.2262 24.4717C44.5558 22.6346 41.0193 24.7341 39.4279 26.265C37.8365 27.7959 35.7146 31.3825 37.5712 42.9297C37.7128 43.9032 37.5862 44.8965 37.205 45.8048C36.8238 46.7132 36.202 47.5029 35.4052 48.0909C25.1494 55.7015 24 59.6818 24 62C24 64.3182 25.1494 68.2985 35.4052 75.9091C36.202 76.4971 36.8238 77.2868 37.205 78.1952C37.5862 79.1035 37.7128 80.0968 37.5712 81.0703C35.8914 92.705 37.8365 96.1604 39.4279 97.735C41.0193 99.3096 44.4674 101.19 56.2262 99.5283C57.2101 99.3883 58.214 99.5135 59.132 99.8907C60.05 100.268 60.8482 100.883 61.4425 101.672C69.1343 111.819 73.1571 113 75.5 113C77.8429 113 81.8657 111.819 89.5575 101.672C90.1518 100.883 90.95 100.268 91.868 99.8907C92.786 99.5135 93.7899 99.3883 94.7738 99.5283C106.577 101.19 109.981 99.2659 111.572 97.735C113.164 96.2041 115.109 92.705 113.429 81.0703C113.287 80.0968 113.414 79.1035 113.795 78.1952C114.176 77.2868 114.798 76.4971 115.595 75.9091C125.851 68.2985 127 64.3182 127 62C127 59.6818 125.851 55.7015 115.595 48.0909Z" fill="#6858E0"/>
						<path d="M72.0015 73.9999C71.4758 74.003 70.9545 73.9022 70.4678 73.7033C69.9811 73.5044 69.5383 73.2114 69.165 72.8411L61.1749 64.8488C60.4226 64.0963 60 63.0757 60 62.0116C60 60.9474 60.4226 59.9268 61.1749 59.1743C61.9272 58.4218 62.9475 57.9991 64.0114 57.9991C65.0753 57.9991 66.0956 58.4218 66.8479 59.1743L72.0015 64.3693L85.1453 51.182C85.5167 50.8075 85.9585 50.5102 86.4454 50.3073C86.9322 50.1045 87.4544 50 87.9818 50C88.5092 50 89.0313 50.1045 89.5182 50.3073C90.005 50.5102 90.4469 50.8075 90.8183 51.182C91.1927 51.5535 91.4899 51.9955 91.6928 52.4825C91.8956 52.9694 92 53.4918 92 54.0193C92 54.5468 91.8956 55.0692 91.6928 55.5561C91.4899 56.0431 91.1927 56.4851 90.8183 56.8565L74.838 72.8411C74.4647 73.2114 74.022 73.5044 73.5353 73.7033C73.0485 73.9022 72.5273 74.003 72.0015 73.9999Z" fill="white"/>
						</svg>

						<div class="ap-head-content ap-finish-content"><?php esc_html_e('AffiliatePress is now ready to power your affiliate program. Feel free to visit the plugin\'s settings page anytime to adjust any options that were configured during the setup wizard.', 'affiliatepress-affiliate-marketing'); ?></div>
						<div class="ap-head-content ap-wizard-social-img">
							<a href="https://www.facebook.com/groups/affiliatepress" target="_blank" rel="noopener noreferrer">
								<?php do_action('affiliatepress_common_svg_code' , 'facebook') ;?>
							</a>
							<a href="https://www.youtube.com/@AffiliatePress/" target="_blank" rel="noopener noreferrer">
								<?php do_action('affiliatepress_common_svg_code' , 'youtube') ;?>
							</a>
						</div>
						<el-button class="el-button el-button--primary ap-btn--primary ap-btn--big ap-exploding" @click="affiliatepress_next_tab('finish_tab')">
							<?php esc_html_e( 'Start Exploring', 'affiliatepress-affiliate-marketing'); ?>
						</el-button>
					</div>
				</div>
			</el-tab-pane>
		</el-tabs>
	</div>

    <div class="ap-fws__footer" v-if="affiliatepress_active_tab != 'finish_tab'">
		<a href="javascript:void(0)" @click="affiliatepress_skip_wizard"><?php esc_html_e('Close and Exit Wizard Without Saving', 'affiliatepress-affiliate-marketing'); ?></a>
	</div>
	
</el-main>