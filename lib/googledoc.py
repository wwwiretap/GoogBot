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
import os.path
import gdata.data
import gdata.acl.data
import gdata.docs.client
import gdata.docs.client
import gdata.docs.service
import gdata.docs.data
import sys
import config
import gdata.client
import gdata.docs

class TorXMPPBot(object):
  APP_NAME = 'Tor XMPP Bot'
  DEBUG = False


def CreateClient():
  client = gdata.docs.client.DocsClient(source=TorXMPPBot.APP_NAME)
  client.http_client.debug = TorXMPPBot.DEBUG
  try:
     client.ClientLogin(config.LOGIN_EMAIL, config.EMAIL_PASS, client.source)
  except gdata.client.BadAuthentication:
    exit('Invalid user credentials given.')
  except gdata.client.Error:
    exit('Login Error')
  return client

client = CreateClient()
def PrintFeed(feed):
  for entry in feed.entry:
    PrintResource(entry)


def PrintResource(resource):
  print resource.resource_id.text, resource.GetResourceType()


# delete all the previously uploaded zip files from google docs
def ShareWithUser(client,email,package):
    for resource in client.GetAllResources():
        if package == resource.title.text:
            acl_entry = gdata.docs.data.AclEntry(
            scope=gdata.acl.data.AclScope(value=email, type='user'),
            role=gdata.acl.data.AclRole(value='reader'),
        )
            try:
                client.add_acl_entry(resource, acl_entry, send_notifications=True)
                print 'Success'
            except gdata.client.Error:
                    exit('Error')

