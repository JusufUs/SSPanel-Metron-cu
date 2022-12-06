<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta charset="UTF-8">
  <title>{$config['documents_name']}</title>
  <link rel="stylesheet" href="//npm.elemecdn.com/docsify/themes/vue.css">
</head>
<body>
  <nav>
    <a href="/">回到主页</a>
      <li><a href="/user/">用户中心</a>
        <ul>
          <li><a href="/user">用户中心</a></li>
          <li><a href="/user/shared_account">共享账号</a></li>
          <li><a href="/user/shop">套餐购买</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="docs">加载中...</div>
  <script>
    const root = window.location.host;
    window.$docsify = {
      name: '{$config['documents_name']}',
      alias: {
            '/.*/_sidebar.md': '/_sidebar.md'
      },
      basePath: '{if $config['remote_documents'] === true}{$config['documents_source']}{else}/docs/{/if}',
      auto2top: true,
      loadSidebar: true,
      autoHeader: true,
      homepage: 'README.md',
      nameLink: '/doc/',
      el: '#docs',
      copyCode: {
          buttonText : '点击拷贝',
          errorText  : '拷贝失败',
          successText: '拷贝成功'
      },
      {literal}
      plugins: [
        function(hook, vm) {
          hook.beforeEach((markdown) => {
            const result = markdown.replace(/\/sublink\?type=(\w+)/g, `//${root}/sublink?type=$1`)
            return result
          })
        }
      ]
      {/literal}
    }
  </script>
  <script src="//npm.elemecdn.com/docsify/lib/docsify.min.js"></script>
  <script src="//npm.elemecdn.com/docsify/lib/plugins/emoji.js"></script>
  <script src="//npm.elemecdn.com/docsify/lib/plugins/zoom-image.js"></script>
  <script src="//npm.elemecdn.com/docsify-copy-code"></script>
  <script src="//npm.elemecdn.com/prismjs/components/prism-yaml.min.js"></script>
</body>
</html>