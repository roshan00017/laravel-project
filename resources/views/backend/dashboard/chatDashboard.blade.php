<hr>
<!-- Chats -->
<div class="row">
    <div class="col-md-6">
        <div class="card direct-chat direct-chat-warning">
            <div class="card-header">
                <h3 class="card-title {{setFont()}}">Chat</h3>

                <div class="card-tools">
                    <span title="3 New Messages" class="badge badge-danger">3</span>
                    <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                        <i class="fas fa-comments"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="direct-chat-messages">
                    <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-left">Dinesh</span>
                            <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                        </div>
                        <img class="direct-chat-img" src="{{asset('images/user21.jpg')}}" alt="message user image">
                        <div class="direct-chat-text bg-white">
                            hey!! What are you doing?
                        </div>
                    </div>

                    <div class="direct-chat-msg right">
                        <div class="direct-chat-infos  clearfix">
                            <span class="direct-chat-name float-right">Dipika</span>
                            <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                        </div>
                        <img class="direct-chat-img" src="{{asset('images/user22.jpg')}}" alt="message user image">
                        <div class="direct-chat-text bg-primary">
                            I am watching movie with my friends.
                        </div>
                    </div>
                </div>

                <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="{{asset('images/avatar5.png')}}" alt="User Avatar">
                                <div class="contacts-list-info">
                                    <span class="contacts-list-name">
                                        Ankit
                                        <small class="contacts-list-date float-right">2/28/2015</small>
                                    </span>
                                    <span class="contacts-list-msg">hello! whats up?......</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="{{asset('images/avatar.png')}}" alt="User Avatar">
                                <div class="contacts-list-info">
                                    <span class="contacts-list-name">
                                        Kapil
                                        <small class="contacts-list-date float-right">2/23/2015</small>
                                    </span>
                                    <span class="contacts-list-msg">hey!! how you doing?......</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-footer">
                <form action="#" method="post">
                    <div class="input-group">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-append">
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Latest Members -->
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title {{setFont()}}">Latest Members</h3>

                <div class="card-tools">
                    <span class="badge badge-warning">6 New Members</span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                <ul class="users-list clearfix">
                    <li>
                        <img src="{{asset('images/avatar5.png')}}" style="max-width: 70%;max-height:70%"
                            alt="User Image">
                        <a class="users-list-name {{setFont()}}" href="#">Bijay</a>
                        <span class="users-list-date">Today</span>
                    </li>
                    <li>
                        <img src="{{asset('images/avatar2.png')}}" style="max-width: 70%;max-height:70%"
                            alt="User Image">
                        <a class="users-list-name {{setFont()}}" href="#">Amrita</a>
                        <span class="users-list-date">Yesterday</span>
                    </li>
                    <li>
                        <img src="{{asset('images/avatar5.png')}}" style="max-width: 70%;max-height:70%"
                            alt="User Image">
                        <a class="users-list-name {{setFont()}}" href="#">Manish</a>
                        <span class="users-list-date">17 June</span>
                    </li>
                    <li>
                        <img src="{{asset('images/avatar5.png')}}" style="max-width: 70%;max-height:70%"
                            alt="User Image">
                        <a class="users-list-name {{setFont()}}" href="#">Bishal</a>
                        <span class="users-list-date">21 June</span>
                    </li>
                    <li>
                        <img src="{{asset('images/avatar5.png')}}" style="max-width: 70%;max-height:70%"
                            alt="User Image">
                        <a class="users-list-name {{setFont()}}" href="#">Binod</a>
                        <span class="users-list-date">22 June</span>
                    </li>
                    <li>
                        <img src="{{asset('images/avatar2.png')}}" style="max-width: 70%;max-height:70%"
                            alt="User Image">
                        <a class="users-list-name {{setFont()}}" href="#">Manjita</a>
                        <span class="users-list-date">24 June</span>
                    </li>
                </ul>
            </div>
            <div class="text-center bg-primary {{setFont()}}">
                <a href="#">View All</a>
            </div>
        </div>
    </div>

    <!-- Active Members -->
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title {{setFont()}}">Active Members</h3>

                <div class="card-tools">
                    <span class="badge badge-success">6 Active Members</span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                <ul class="users-list clearfix">
                    <li>
                        <img src="{{asset('images/avatar5.png')}}" style="max-width: 70%;max-height:70%"
                            alt="User Image">
                        <a class="users-list-name {{setFont()}}" href="#">Bijay</a>
                        <span class="users-list-date">Today</span>
                    </li>
                    <li>
                        <img src="{{asset('images/avatar2.png')}}" style="max-width: 70%;max-height:70%"
                            alt="User Image">
                        <a class="users-list-name {{setFont()}}" href="#">Amrita</a>
                        <span class="users-list-date">Yesterday</span>
                    </li>
                    <li>
                        <img src="{{asset('images/avatar5.png')}}" style="max-width: 70%;max-height:70%"
                            alt="User Image">
                        <a class="users-list-name {{setFont()}}" href="#">Manish</a>
                        <span class="users-list-date">17 June</span>
                    </li>
                    <li>
                        <img src="{{asset('images/avatar5.png')}}" style="max-width: 70%;max-height:70%"
                            alt="User Image">
                        <a class="users-list-name {{setFont()}}" href="#">Bishal</a>
                        <span class="users-list-date">21 June</span>
                    </li>
                    <li>
                        <img src="{{asset('images/avatar5.png')}}" style="max-width: 70%;max-height:70%"
                            alt="User Image">
                        <a class="users-list-name {{setFont()}}" href="#">Binod</a>
                        <span class="users-list-date">22 June</span>
                    </li>
                    <li>
                        <img src="{{asset('images/avatar2.png')}}" style="max-width: 70%;max-height:70%"
                            alt="User Image">
                        <a class="users-list-name {{setFont()}}" href="#">Manjita</a>
                        <span class="users-list-date">24 June</span>
                    </li>
                </ul>
            </div>
            <div class="text-center bg-primary {{setFont()}}">
                <a href="#">View All</a>
            </div>
        </div>
    </div>
</div>
<hr>
