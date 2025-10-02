@extends('layouts.app')

@section('title', 'Communications - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <div class="flex">
        @include('admin.admin-dashboard.partials.sidebar')
        
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Communications</h1>
                        <p class="text-gray-600 mt-1">Manage email, SMS, and newsletter communications</p>
                    </div>
                </div>
            </div>

            <!-- Communication Tabs -->
            <div class="mb-6 border-b border-gray-200">
                <nav class="flex space-x-8">
                    <a href="#" class="border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Email Notifications
                    </a>
                    <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        SMS Notifications
                    </a>
                    <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Newsletter
                    </a>
                    <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Announcements
                    </a>
                </nav>
            </div>

            <!-- Email Notifications -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Send Email -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Send Email Notification</h3>
                    
                    <form>
                        <div class="space-y-4">
                            <div>
                                <label for="recipient" class="block text-sm font-medium text-gray-700 mb-1">Recipient(s)</label>
                                <select id="recipient" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="all_users">All Users</option>
                                    <option value="employers">All Employers</option>
                                    <option value="job_seekers">All Job Seekers</option>
                                    <option value="specific">Specific Users</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                                <input type="text" id="subject" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                       placeholder="Enter email subject">
                            </div>
                            
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                <textarea id="message" rows="6" 
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                          placeholder="Enter your message here..."></textarea>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" id="include_unsubscribe" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="include_unsubscribe" class="ml-2 block text-sm text-gray-700">
                                    Include unsubscribe link
                                </label>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" 
                                        class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300">
                                    Send Email
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Email Templates -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Email Templates</h3>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800">+ Add Template</a>
                    </div>
                    
                    <div class="space-y-3">
                        <a href="#" class="block p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <div class="font-medium text-gray-900">Welcome Email</div>
                            <div class="text-sm text-gray-500 mt-1">Sent to new users after registration</div>
                        </a>
                        
                        <a href="#" class="block p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <div class="font-medium text-gray-900">Job Application Notification</div>
                            <div class="text-sm text-gray-500 mt-1">Sent to employers when a new application is received</div>
                        </a>
                        
                        <a href="#" class="block p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <div class="font-medium text-gray-900">Password Reset</div>
                            <div class="text-sm text-gray-500 mt-1">Sent when users request password reset</div>
                        </a>
                        
                        <a href="#" class="block p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <div class="font-medium text-gray-900">Subscription Expiry Reminder</div>
                            <div class="text-sm text-gray-500 mt-1">Sent to employers before subscription expires</div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Notifications -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Recent Notifications</h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notification</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recipients</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sent</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">System Maintenance Notice</div>
                                    <div class="text-sm text-gray-500">Scheduled maintenance on October 5th, 2025</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">All Users</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Email
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Sent
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Sep 30, 2025
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">View</a>
                                </td>
                            </tr>
                            
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">New Job Postings This Week</div>
                                    <div class="text-sm text-gray-500">Check out the latest opportunities</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Job Seekers</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        SMS
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Sent
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Sep 28, 2025
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">View</a>
                                </td>
                            </tr>
                            
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">Monthly Newsletter</div>
                                    <div class="text-sm text-gray-500">Industry insights and platform updates</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Subscribers</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        Newsletter
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Scheduled
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Oct 5, 2025
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                    <a href="#" class="text-red-600 hover:text-red-900">Cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 border-t border-gray-200">
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">
                        View All Notifications →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection