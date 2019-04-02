#!/bin/bash

# system_version controller
CTL="${BASEURL}index.php?/module/system_version/"

# Get the scripts in the proper directories
"${CURL[@]}" "${CTL}get_script/system_version" -o "${MUNKIPATH}preflight.d/system_version"

# Check exit status of curl
if [ $? = 0 ]; then
	# Make executable
	chmod a+x "${MUNKIPATH}preflight.d/system_version"

	# Set preference to include this file in the preflight check
	setreportpref "system_version" "/System/Library/CoreServices/SystemVersion.plist"

else
	echo "Failed to download all required components!"
	rm -f "${MUNKIPATH}preflight.d/system_version"

	# Signal that we had an error
	ERR=1
fi
