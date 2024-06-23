wp post list --field=ID --post_type=product | xargs wp post delete --force --quiet
wp post list --field=ID --post_type='attachment' | xargs wp post delete --force --quiet
wp wc product create --name="Test Product 1" --regular_price="99.99" --images="[{\"id\":$(wp media import https://fastly.picsum.photos/id/80/1000/800.jpg?hmac=WjGit4A6c_-7pfr0nm5Skr98plcicnAUdHd5bqDNLqQ --porcelain)}]" --user=1
wp wc product create --name="Test Product 2" --regular_price="100.99" --images="[{\"id\":$(wp media import https://fastly.picsum.photos/id/145/1000/800.jpg?hmac=9-wDqKYkJAo2inXTmJh2_fGe0RzW5dAL9Wxb0_NJ820 --porcelain)}]" --user=1
wp wc product create --name="Test Product 3" --regular_price="200.99" --images="[{\"id\":$(wp media import https://fastly.picsum.photos/id/39/1000/800.jpg?hmac=L4Gm1JVLBkvznJC1IAwM3zjjo6Hem-x6nGJe4258nZU --porcelain)}]" --user=1
