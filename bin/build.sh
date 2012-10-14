#!/bin/sh

## Build boxmeup distribution package.

NAME="BMU_BUILD"
BUILDNUM=$(date +"%Y%m%d%H%M%S")
BUILD_PATH=/tmp/boxmeup$BUILDNUM
CURRENT_PATH=$(pwd)

git pull && git submodule update --init
if [ $? != 0 ]
then
	echo "Git pull or submodule update failed."
	exit 1
fi

echo "Copying files to build path..."
cp -R ./ $BUILD_PATH/

echo "Clearing app cache/logs..."
rm $BUILD_PATH/app/tmp/cache/models/boxmeup_cake_model_default_boxmeup_*
rm $BUILD_PATH/app/tmp/cache/persistent/boxmeup_cake_core_*
rm $BUILD_PATH/app/tmp/logs/*.log

echo "Copying production configurations..."
cp config/bootstrap.php config/core.php config/database.php $BUILD_PATH/app/Config/

if [ $? != 0 ]
then
	echo "Failed to copy production configurations into build path."
	exit 1
fi

echo "Zipping up project..."
cd $BUILD_PATH
zip -r -q $BUILD_PATH.zip . \
	-x "*.git*" -x "wordpress/*" \
	-x "chromeapp/*" -x "bin/*" \
	-x "config/*"

if [ $? != 0 ]
then
	echo "Build zip failed."
	cd $CURRENT_PATH
	exit 1
fi
cd $CURRENT_PATH

echo "Cleaning up..."
rm -rf $BUILD_PATH

mv $BUILD_PATH.zip ~
echo "Build successful: boxmeup$BUILDNUM"
