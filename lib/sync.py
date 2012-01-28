#!/usr/bin/python
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
import os
import sys
import string
import subprocess
import gdata.data
import gdata.acl.data
import gdata.docs.client
import gdata.docs.data
import sqlite3
import googledoc

db = sqlite3.connect('db/doclist') # might need to use self.filename
db.execute("CREATE TABLE IF NOT EXISTS doclist(id text, title text)")
db.commit()

client = googledoc.CreateClient()

# windows sync function - create zip files and upload to google docs
def SyncGnuLinuxi386(languages):
  for language in languages:
    bundlename = []
    bundlenumber = []
    packagename = 'tor-browser-gnu-linux-i686'
    magic = []
    rootdir = './torbrowser/linux/'
    for root, subFolders, files in os.walk(rootdir):
        for file in files:
            check = file.find(language)
            if check !=-1:
                  if file.find('tor-browser-gnu-linux-i686') !=-1:
                    splitname = string.split(file, '-dev-ar.tar.gz')
                    bundlenumber.append(splitname[0][-1])
                    namesplit = string.split(file, '-')
                    vernum = namesplit[5]
                    # check value for archive process
                    runzip = splitname[0][-1]
                    # we use the latest version we find to make our zip file
                    magic.append(namesplit[6])


    manlang = language

    if language == 'en-US':
       manlang = 'en'
    elif language == 'es-ES':
       manlang = 'es'
    elif language == 'zh-CN':
       manlang = 'zh'

    if magic:
     zipfile = packagename + '-' + language + '.zip'
     appfile = packagename + '-' + vernum + '-' + max(magic) + '-dev-' + language + '.tar.gz'
     ascfile = packagename + '-' + vernum + '-' + max(magic) + '-dev-' + language + '.tar.gz.asc'
     manfile = 'short-user-manual_' + manlang + '.xhtml'

     subprocess.call(["7z" ,"a",'zipfiles/linux/' + zipfile,'torbrowser/linux/'+appfile,'torbrowser/linux/'+ascfile, 'manual/'+manfile])
     f = open('./zipfiles/linux/'+zipfile)
     doc = gdata.docs.data.Resource(type='zip', title=zipfile)
     ms = gdata.data.MediaSource(file_handle=f, content_type='application/zip', content_length=os.path.getsize(f.name))
     # Pass the convert=false parameter
     create_uri = gdata.docs.client.RESOURCE_UPLOAD_URI + '?convert=false'
     doc = client.CreateResource(doc, create_uri=create_uri, media=ms)
     print 'Created, and uploaded:', doc.title.text, doc.resource_id.text
     db.execute('INSERT INTO doclist(id, title) VALUES(?,?)', (doc.resource_id.text, doc.title.text))
     db.commit()


def SyncGnuLinux64(languages):
  for language in languages:
    bundlename = []
    bundlenumber = []
    packagename = 'tor-browser-gnu-linux-x86_64'
    magic = []
    rootdir = './torbrowser/linux/'
    for root, subFolders, files in os.walk(rootdir):
        for file in files:
            check = file.find(language)
            if check !=-1:
                  if file.find('tor-browser-gnu-linux-x86_64') !=-1:
                    splitname = string.split(file, '-dev-')
                    bundlenumber.append(splitname[0][-1])
                    namesplit = string.split(file, '-')
                    vernum = namesplit[5]
                    # check value for archive process
                    runzip = splitname[0][-1]
                    # we use the latest version we find to make our zip file
                    magic.append(namesplit[6])


    manlang = language

    if language == 'en-US':
       manlang = 'en'
    elif language == 'es-ES':
       manlang = 'es'
    elif language == 'zh-CN':
       manlang = 'zh'

    if magic:
     zipfile = packagename + '-' + language + '.zip'
     appfile = packagename + '-' + vernum + '-' + max(magic) + '-dev-' + language + '.tar.gz'
     ascfile = packagename + '-' + vernum + '-' + max(magic) + '-dev-' + language + '.tar.gz.asc'
     manfile = 'short-user-manual_' + manlang + '.xhtml'

     subprocess.call(["7z" ,"a",'zipfiles/linux/' + zipfile,'torbrowser/linux/'+appfile,'torbrowser/linux/'+ascfile, 'manual/'+manfile])
     f = open('./zipfiles/linux/'+zipfile)
     doc = gdata.docs.data.Resource(type='zip', title=zipfile)
     ms = gdata.data.MediaSource(file_handle=f, content_type='application/zip', content_length=os.path.getsize(f.name))
     # Pass the convert=false parameter
     create_uri = gdata.docs.client.RESOURCE_UPLOAD_URI + '?convert=false'
     doc = client.CreateResource(doc, create_uri=create_uri, media=ms)
     print 'Created, and uploaded:', doc.title.text, doc.resource_id.text
     db.execute('INSERT INTO doclist(id, title) VALUES(?,?)', (doc.resource_id.text, doc.title.text))
     db.commit()



def SyncWindows(languages):
  for language in languages:
    bundlename = []
    bundlenumber = []
    packagename = 'tor-browser'
    magic = []
    rootdir = './torbrowser'
    for root, subFolders, files in os.walk(rootdir):
        for file in files:
            check = file.find(language + '.exe')
            if check !=-1:
                splitname = string.split(file, '_')
                bundlenumber.append(splitname[0][-1])
                namesplit = string.split(file, 'tor-browser-')
                tempdata = string.split(namesplit[1], '-')
                vernum = tempdata[0]
                # check value for archive process
                runzip = splitname[0][-1]
                # we use the latest version we find to make our zip file
                magic.append(splitname[0][-1])

    manlang = language

    if language == 'en-US':
       manlang = 'en'
    elif language == 'es-ES':
       manlang = 'es'
    elif language == 'zh-CN':
       manlang = 'zh'

    if magic:
     zipfile = packagename + '-' + language + '.zip'
     appfile = packagename + '-' + vernum + '-' + max(magic) + '_' + language + '.exe'
     ascfile = packagename + '-' + vernum + '-' + max(magic) + '_' + language + '.exe.asc'
     manfile = 'short-user-manual_' + manlang + '.xhtml'
     subprocess.call(["7z" ,"a",'zipfiles/windows/' + zipfile,'torbrowser/'+appfile,'torbrowser/'+ascfile, 'manual/'+manfile])
     f = open('./zipfiles/windows/'+zipfile)
     doc = gdata.docs.data.Resource(type='zip', title=zipfile)
     ms = gdata.data.MediaSource(file_handle=f, content_type='application/zip', content_length=os.path.getsize(f.name))
     # Pass the convert=false parameter
     create_uri = gdata.docs.client.RESOURCE_UPLOAD_URI + '?convert=false'
     doc = client.CreateResource(doc, create_uri=create_uri, media=ms)
     print 'Created, and uploaded:', doc.title.text, doc.resource_id.text
     db.execute('INSERT INTO doclist(id, title) VALUES(?,?)', (doc.resource_id.text, doc.title.text))
     db.commit()

def SyncOsx64(languages):
  for language in languages:
    bundlename = []
    bundlenumber = []
    packagename = 'tor-browser-osx-x86_64-dev'
    # TorBrowser-2.2.35-3-dev-osx-x86_64-fr.zip.asc
    magic = []
    rootdir = './torbrowser/osx/'
    for root, subFolders, files in os.walk(rootdir):
        for file in files:
            check = file.find(language)
            if check !=-1:
                  if file.find('dev-osx-x86_64') !=-1:
                    namesplit = string.split(file, '-')
                    vernum = namesplit[1]
                    # we use the latest version we find to make our zip file
                    magic.append(namesplit[2])


    manlang = language

    if language == 'en-US':
       manlang = 'en'
    elif language == 'es-ES':
       manlang = 'es'
    elif language == 'zh-CN':
       manlang = 'zh'

    if magic:
     zipfile = packagename + '-' + language + '.zip'
     #  TorBrowser-2.2.35-3-dev-osx-i386-ar.zip
     appfile = 'TorBrowser' + '-' + vernum + '-' + max(magic) + '-dev-osx-x86_64-' + language + '.zip'
     ascfile = 'TorBrowser' + '-' + vernum + '-' + max(magic) + '-dev-osx-x86_64-' + language + '.zip.asc'
     manfile = 'short-user-manual_' + manlang + '.xhtml'
     subprocess.call(["7z" ,"a",'zipfiles/osx/' + zipfile,'torbrowser/osx/'+appfile,'torbrowser/osx/'+ascfile, 'manual/'+manfile])
     f = open('./zipfiles/osx/'+zipfile)
     doc = gdata.docs.data.Resource(type='zip', title=zipfile)
     ms = gdata.data.MediaSource(file_handle=f, content_type='application/zip', content_length=os.path.getsize(f.name))
     # Pass the convert=false parameter
     create_uri = gdata.docs.client.RESOURCE_UPLOAD_URI + '?convert=false'
     doc = client.CreateResource(doc, create_uri=create_uri, media=ms)
     print 'Created, and uploaded:', doc.title.text, doc.resource_id.text
     db.execute('INSERT INTO doclist(id, title) VALUES(?,?)', (doc.resource_id.text, doc.title.text))
     db.commit()

def SyncOsxi386(languages):
  for language in languages:
    bundlename = []
    bundlenumber = []
    packagename = 'tor-browser-osx-i386-dev'
    # TorBrowser-2.2.35-3-dev-osx-i386-ar.zip
    magic = []
    rootdir = './torbrowser/osx/'
    for root, subFolders, files in os.walk(rootdir):
        for file in files:
            check = file.find(language)
            if check !=-1:
                  if file.find('dev-osx-i386') !=-1:
                    namesplit = string.split(file, '-')
                    vernum = namesplit[1]
                    # we use the latest version we find to make our zip file
                    magic.append(namesplit[2])


    manlang = language

    if language == 'en-US':
       manlang = 'en'
    elif language == 'es-ES':
       manlang = 'es'
    elif language == 'zh-CN':
       manlang = 'zh'

    if magic:
     zipfile = packagename + '-' + language + '.zip'
     #  TorBrowser-2.2.35-3-dev-osx-i386-ar.zip
     appfile = 'TorBrowser' + '-' + vernum + '-' + max(magic) + '-dev-osx-i386-' + language + '.zip'
     ascfile = 'TorBrowser' + '-' + vernum + '-' + max(magic) + '-dev-osx-i386-' + language + '.zip.asc'
     manfile = 'short-user-manual_' + manlang + '.xhtml'
     subprocess.call(["7z" ,"a",'zipfiles/osx/' + zipfile,'torbrowser/osx/'+appfile,'torbrowser/osx/'+ascfile, 'manual/'+manfile])
     f = open('./zipfiles/osx/'+zipfile)
     doc = gdata.docs.data.Resource(type='zip', title=zipfile)
     ms = gdata.data.MediaSource(file_handle=f, content_type='application/zip', content_length=os.path.getsize(f.name))
     # Pass the convert=false parameter
     create_uri = gdata.docs.client.RESOURCE_UPLOAD_URI + '?convert=false'
     doc = client.CreateResource(doc, create_uri=create_uri, media=ms)
     print 'Created, and uploaded:', doc.title.text, doc.resource_id.text
     db.execute('INSERT INTO doclist(id, title) VALUES(?,?)', (doc.resource_id.text, doc.title.text))
     db.commit()
