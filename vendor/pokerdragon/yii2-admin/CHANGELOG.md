Yii2 Admin Change Log
==========================

2.5
-----

- Enh: Add code testing (pdunir).
- Enh: Add more documentation (pdunir).

2.0
---------------------

- Chg: Remove dependenci to `yiisoft/yii2-jui` (pdunir).
- Chg: Add asset bundle for jui autocomplete (pdunir).


1.0.4
-----------------------

- Bug: #102: Unique validation of the permission and role (pdunir).
- Enh: Clear cache when menu change (pdunir).
- Enh: Ensure get latest state of `user` component (pdunir).


1.0.3
------


1.0.2
------

- Enh: Add Portuguese language to translation message (iforme).
- Enh: configurable Navbar defined in module config (Stefano Mtangoo).
- Enh: Add Italian language to translation message (realtebo).

1.0.1
-----

- Enh: Add Persian language to translation message (jafaripur).
- Enh: Add French language to translation message (marsuboss).


1.0.0
-----

- Enh: Internationalization (sosojni).
- Enh: Add Russian language to translation message (m0zart89).


1.0.0-rc 
--------

- Bug #12: Allow another module name (pdunir).
- Bug: #19: Added table prefix to table `menu` for some query (pdunir, liu0472).
- Bug: #24: change `$cache === null` to `isset($cache)` (pdunir).
- Bug: Bug fix. Ensure array has index before check `in_array()` (pdunir).
- Bug: Typo fix, replace `AssigmentController` to `AssignmentController` (pdunir).
- Enh: Custom side menu via `pokerDragon\admin\Module::items` (pdunir).
- Enh: Added menu manager (pdunir).
- Enh: Migration for table menu (pdunir).
- Enh: Added Menu order (pdunir).
- Enh: Add `db` and `cache` configuration (pdunir).
- Enh: Add comment docs for entire class (pdunir).
- Enh: Add documentation (pdunir).
- Enh #57: Allow user to assign permission directly (pdunir).
- Chg #10: `cache` is not used anymore (pdunir).
- Chg #11: Only use required style sheet (pdunir).
- Chg: Using `VarDumper::export` to save `data` of `pokerDragon\models\AuthItem` (pdunir).
- Chg: Allow using another `yii\rbac\Rule` instance (pdunir).
- Chg: Remove prefix `menu_` from column name of table `menu` (pdunir).
- Chg: Added column `data` to table `menu` (pdunir).
- Chg: Can customize return of `pokerDragon\admin\components\AccessHelper::getAssignedMenu()` with provide a callback to method (pdunir). 
- Chg: Add require "yiisoft/yii2-jui" to composer.json (pdunir, hashie5).
- Chg: #21: Force set allow `null` to column `parent` in database migration (pdunir).
- Chg: Remove `pokerDragon\admin\components\BizRule` (pdunir).
- Chg: Change convert string to `yii\rbac\Item::$data` with `Json::decode()` (pdunir).
- Chg: Add extra param to route (pdunir).
- Chg: Add ability to get sparated menu. See [Using Menu](docs/guide/using-menu.md) (pdunir).
- Chg: Refactor layout (pdunir).
- Chg: Change `AccessHelper` to `MenuHelper` (pdunir).
- Chg: Change migration path name (pdunir).
- Chg: `db` and `cache` configuration via `$app->params['pd.admin.configs']` (pdunir).
- Chg: #29: Change `yii\caching\GroupDependency` to `yii\caching\TagDependency` (pdunir).
- Chg: Remove `pokerDragon\admin\Module::allowActions`. Set access control directly with `pokerDragon\admin\components\AccessControl` (pdunir).
- Chg: Change cache strategy (pdunir).
- Chg: `pokerDragon\admin\components\DbManager` now inherited from `yii\rbac\DbManager` (pdunir).
- Chg: Change module default layout (pdunir).
- Chg: Change back items to controllers (pdunir).
- Chg: Set default layout to `null` (pdunir).
- Chg #53: Fixed typo. Change Role to Permission (pdunir).
- Chg: Simplify using layout (pdunir).
