 
 
 <td><a href="#"><span class="badge bg-success jobDesBtn" data-id="' + item.id + '" \
                                                        data-firstname="' + item.firstname + '" \
                                                        data-secondname="' + secondname + '" \
                                                        data-lastname="' + lastname + '" \
                                                        data-phonenumber="' + item.phonenumber + '" \
                                                        data-email="' + item.email + '" \
                                                        data-update_course_id="' + item.course.id + '" \
                                                        data-update_clas_id="' + item.clas.id + '" \
                                                        data-role="' + item.role + '" \
                                                        data-gender="' + item.gender + '" \
                                                        data-status="' + item.status + '" \> <i class="fa fa-edit"></i> Update</span></a>\
                                    <a href="#"><span class="badge bg-danger deleteBtn" data-id="' + item.id + '"> <i class="fa fa-trash"></i> Delete</span></a>\
                                    <a href="#"><span class="badge bg-danger updatePasswordBtn" data-id="' + item.id + '"> <i class="fa fa-trash"></i> Update Password</span></a>\
                                    <a class="viewQuestionsBtn text-info" href="' + baseUrl + '?user_id=' + item.id + '" target="_blank">\
                                        <span class="badge bg-secondary"> <i class="fa fa-bars" aria-hidden="true"></i> Manage Fee<\span>\
                                    </a>\
                                    </td>\