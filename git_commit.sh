git filter-branch --env-filter "export GIT_COMMITTER_NAME='lightstar-web' export GIT_COMMITTER_EMAIL='dev.star.man0412@gmail.com' export GIT_AUTHOR_NAME='lightstar-web' export GIT_AUTHOR_EMAIL='dev.star.man0412@gmail.com'" --tag-name-filter cat -- --branches --tags
git push --all
git push --tags