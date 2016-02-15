//
//  GameBigCell.swift
//  SafeInRio
//
//  Created by Bruno Baring on 12/Dec/15.
//  Copyright © 2015 Amanda Aurita Araujo Fernandes. All rights reserved.
//


import UIKit

class BetCollectionCell: UICollectionViewCell {
    
    var flagPicture: UIImageView!
    
    //var image: UIImage!
    
    override init(frame: CGRect) {
        super.init(frame: frame)
        flagPicture = UIImageView(frame: CGRectMake(10, 10, 10, 10))
        flagPicture.contentMode = UIViewContentMode.ScaleAspectFill
        self.addSubview(flagPicture)
        addSubview(flagPicture)
    }

    required init?(coder aDecoder: NSCoder) {
        fatalError("init(coder:) has not been implemented")
    }
    
//    required init?(coder aDecoder: NSCoder) {
//        super.init(coder: aDecoder)
//    }
    
}
