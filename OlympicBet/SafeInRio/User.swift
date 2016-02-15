//
//  User.swift
//  SafeInRio
//
//  Created by Bruno Baring on 12/Dec/15.
//  Copyright © 2015 Amanda Aurita Araujo Fernandes. All rights reserved.
//

import Foundation


class User {
    var name: NSString?
    var email: NSString?
    var password: NSString?
    var id: Int?
    var medals: NSString?
    var goldmedals: Int?
    var silvermedals: Int?
    var bronzemedals: Int?
    var score: Int?
    var bets = [Bet]()
    init(){}
}