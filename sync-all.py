#!/usr/bin/python
# Copyright (c) 2012 Expression Technologies <info@expressiontech.org>
# Copyright (c) 2012 SiNA <sina@redteam.io>
# Copyright (c) 2012 The Tor Project, Inc
#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation; either version 3 of the
# License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful, but
# WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
# General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307
# USA
#
# rsync torbrowser folder from the rsync server locally
# create zip archives
# upload to google doc
# insert ID in doclist DB

import lib.sync
import lib.googledoc
import subprocess
import lib.config
import commands

languages = lib.config.languages

commands.getstatus('[ -d torbrowser ] || mkdir torbrowser')
commands.getstatus('[ -d manual ] || mkdir manual')
commands.getstatus('[ -d zipfiles ] || mkdir zipfiles')

# create/update local mirror of torbrowser and manual folders
print subprocess.call(["rsync" ,"-av","--delete","rsync://rsync.torproject.org/tor/dist/torbrowser/","torbrowser/"])
print subprocess.call(["rsync" ,"-av","--delete","rsync://rsync.torproject.org/tor/dist/manual/","manual/"])

client = lib.googledoc.CreateClient()

# delete all the previously uploaded zip files from google docs
for resource in client.GetAllResources():
    print resource.GetEditLink().href
    client.Delete(resource.GetEditLink().href + '?delete=true', force=True)

# Create zip files and upload to google docs
# Insert ID and title to local database

lib.sync.SyncGnuLinuxi386(languages)
lib.sync.SyncGnuLinux64(languages)
lib.sync.SyncWindows(languages)
lib.sync.SyncOsx64(languages)
lib.sync.SyncOsxi386(languages)
