@extends('layouts.app')

@section('title', 'Reported Content - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <div class="flex">
        @include('admin.admin-dashboard.partials.sidebar')
        
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Reported Content</h1>
                        <p class="text-gray-600 mt-1">Review and manage reported content</p>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="mb-6 border-b border-gray-200">
                <nav class="flex space-x-8">
                    <a href="#" class="border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        All Reports
                    </a>
                    <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Jobs
                    </a>
                    <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Employers
                    </a>
                    <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Job Seekers
                    </a>
                </nav>
            </div>

            <!-- Reports Table -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reported Content</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reporter</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">Senior Frontend Developer</div>
                                    <div class="text-sm text-gray-500">Posted by: Tech Solutions Inc.</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Inappropriate Content
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">John Doe</div>
                                    <div class="text-sm text-gray-500">jobseeker@example.com</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Oct 1, 2025
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Review</a>
                                    <a href="#" class="text-green-600 hover:text-green-900 mr-3">Approve</a>
                                    <a href="#" class="text-red-600 hover:text-red-900">Remove</a>
                                </td>
                            </tr>
                            
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">Digital Marketing Specialist</div>
                                    <div class="text-sm text-gray-500">Posted by: Marketing Pro Ltd.</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Duplicate Post
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">Sarah Johnson</div>
                                    <div class="text-sm text-gray-500">sarah@example.com</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Sep 28, 2025
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Review</a>
                                    <a href="#" class="text-green-600 hover:text-green-900 mr-3">Approve</a>
                                    <a href="#" class="text-red-600 hover:text-red-900">Remove</a>
                                </td>
                            </tr>
                            
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">Tech Solutions Inc.</div>
                                    <div class="text-sm text-gray-500">Employer Profile</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        Suspicious Activity
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">Michael Brown</div>
                                    <div class="text-sm text-gray-500">michael@example.com</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Sep 25, 2025
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Review</a>
                                    <a href="#" class="text-green-600 hover:text-green-900 mr-3">Approve</a>
                                    <a href="#" class="text-red-600 hover:text-red-900">Remove</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">3</span> results
                        </div>
                        <div class="flex space-x-2">
                            <a href="#" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Previous</a>
                            <a href="#" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Next</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Instructions -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mt-6">
                <h3 class="text-lg font-medium text-blue-800 mb-2">Moderation Guidelines</h3>
                <ul class="list-disc pl-5 space-y-1 text-blue-700">
                    <li>Review all reports within 24 hours of submission</li>
                    <li>Contact reporters if additional information is needed</li>
                    <li>Document all moderation decisions for audit purposes</li>
                    <li>Suspend repeat offenders after 3 verified violations</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection